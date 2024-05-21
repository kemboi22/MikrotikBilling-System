<script setup lang="ts">
import {Button} from '@/components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {Input} from '@/components/ui/input'
import {Label} from '@/components/ui/label'
import {ref} from "vue";
import {Router} from "@/types";

const form = ref<Router>(<Router>{})
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button>
                Add Router
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Add Router</DialogTitle>
                <DialogDescription>
                    Add router and Connect To It
                </DialogDescription>
            </DialogHeader>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-full">
                    <Label>Router Name</Label>
                    <Input type="text" v-model="form.name" class="" placeholder="Home Router" autocomplete/>
                </div>
                <div class="lg:col-span-6 col-span-full">
                    <Label>IP Address</Label>
                    <Input type="text" v-model="form.ipAddress" class="" placeholder="192.168.11.1" autocomplete autofocus/>
                </div>
                <div class="lg:col-span-6 col-span-full">
                    <Label>Port</Label>
                    <Input type="number" v-model="form.port" class="" placeholder="8728" autocomplete autofocus/>
                </div>
                <div class="lg:col-span-6  col-span-full">
                    <Label>Username</Label>
                    <Input type="text" v-model="form.username" class="" placeholder="admin" autocomplete/>
                </div>
                <div class="lg:col-span-6  col-span-full">
                    <Label>Password</Label>
                    <Input type="password" v-model="form.password" class="" placeholder="*********" autocomplete/>
                </div>
            </div>
            <DialogFooter>
                <Button type="submit">
                    Save
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
