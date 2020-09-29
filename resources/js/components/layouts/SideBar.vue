<template>
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><router-link :to="{ name: 'dashboard' }"><i class="lnr lnr-home"></i> <span>Dashboard</span></router-link></li>
                    <li><router-link :to="{ name: 'profile' }"><i class="lnr lnr-pencil"></i>Edit Password</router-link></li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    export default {

    }
</script>
