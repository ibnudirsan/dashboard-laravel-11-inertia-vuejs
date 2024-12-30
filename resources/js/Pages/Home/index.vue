<script setup>
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import Layout from '@/layout/app.vue';
</script>

<template>
    <Layout>
        <Head title="Welcome" />
        <h1 class="text-blue-900 text-center p-5">Hello world!</h1>
        <Button>Click Me</Button>
    </Layout>
</template>