<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Infusionsoft\InfusionsoftRequest;
use App\Http\Resources\InfusionsoftAccountLogCollection;
use App\Http\Resources\InfusionsoftCollection;
use App\Models\InfusionsoftAccount;
use App\Repositories\Interfaces\InfusionsoftInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Helper;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class InfusionsoftAccountController extends ApiController
{

    private $faker;

    public function __construct(InfusionsoftInterface $repository) {
        $this->repository = $repository;
        $this->faker = Faker::create();
    }

    /**
     * @param Request $request
     * @return InfusionsoftCollection
     */
    public function index(Request $request)
    {
        return InfusionsoftCollection::make($this->repository->collection(['user_id' => $request->input('id')]));
    }

    public function create(InfusionsoftRequest $request)
    {
       try {
            $data = $request->only('app_name', 'user_id');

            $data['access_token'] = Helper::quickRandom(100);
            $data['refresh_token'] = Helper::quickRandom(100);
            $data['auth_key'] = Helper::quickRandom(100);

            $infusionsoft_account = $this->repository->store($data);

           for($i = 1 ; $i <= 15 ; $i++)
           {
               DB::table('infusionsoft_logs')->insert([
                   'app_name' => $infusionsoft_account->app_name,
                   'auth_key' => $infusionsoft_account->auth_key,
                   'data' => $this->faker->paragraph(4),
                   'created_at' => now()->subDays(rand(100,1000)),
                   'updated_at' => now()->subDays(rand(100,1000))
               ]);
           }

            return response()->json([
                'status' => 'Success',
                'message' => 'Successfully Added Account',
                'account' => $infusionsoft_account
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {

        try {
            $account = $this->repository->find($id);

            if($account) {
                $account->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted Account'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Request $request
     * @param $app
     * @return InfusionsoftAccountLogCollection|\Illuminate\Http\JsonResponse
     */
    public function accountLogs(Request $request, $app)
    {
        try {
            $account = $this->repository
                        ->findBy(['app_name' => $app])
                            ->first();

            if(!$account) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], Response::HTTP_NOT_FOUND);
            }

            $data = $account
                ->logs()
                ->orderBy('created_at', 'DESC')
                ->get();

            return InfusionsoftAccountLogCollection::make($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
