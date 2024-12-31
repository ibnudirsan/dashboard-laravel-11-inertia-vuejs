<script setup>
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Link } from '@inertiajs/vue3'

import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const errors = ref({});

/**
 * Submits the signup form to the server.
 *
 * @return {void}
 */
const submit = () => {
    form.post('/store-signup', {
        /**
         * Updates the errors value with the provided error.
         *
         * @param {Object} error - The error object to be assigned to errors.value.
         * @return {void}
         */
        onError: (error) => {
            errors.value = error;
        }
    })
}
</script>

<template>
    <title>Signup Screen</title>
    <div class="mx-auto h-screen w-screen flex justify-center items-center ">
        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-xl">
                    Sign Up
                </CardTitle>
                <CardDescription>
                    Enter your information to create an account
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid  gap-4">
                            <div class="grid gap-2">
                                <Label for="username">Username</Label>
                                <Input id="username"
                                    v-model="form.name"
                                    :class="{'is-invalid': errors.name}"
                                    type="text"
                                    autocomplete="off"
                                    placeholder="johndoe"
                                    autofocus/>
                                <span class="text-red-800" v-if="errors.name">{{ errors.name }}</span>
                            </div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email"
                                v-model="form.email"
                                :class="{'is-invalid': errors.email}"
                                type="email"
                                placeholder="example@mail.com"
                                autocomplete="off"/>
                            <span class="text-red-800" v-if="errors.email">{{ errors.email }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input id="password"
                                v-model="form.password"
                                :class="{'is-invalid': errors.password}"
                                type="password" 
                                placeholder="******************"/>
                            <span class="text-red-800" v-if="errors.password">{{ errors.password }}</span>
                            <Label for="password">Password Confirm</Label>
                            <Input id="password_confirm"
                                v-model="form.password_confirmation"
                                :class="{'is-invalid': errors.password_confirmation}"
                                type="password"
                                placeholder="******************"/>
                        </div>
                        <Button type="submit" class="w-full">
                            Create an account
                        </Button>
                        <Button variant="outline" class="w-full" disabled>
                            Sign up with GitHub
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Already have an account?
                        <Link href="/login" class="underline">
                            Sign in
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
