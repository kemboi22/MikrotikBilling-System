<script setup lang="ts">
import {Button} from '@/components/ui/button'
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {Input} from '@/components/ui/input'
import {Label} from '@/components/ui/label'
import {ref, watch} from "vue";
import {Router} from "@/types";
import {useFetch} from "@/Composables/fetch";
import Loader from "@/Components/Loader.vue";

// Props
const props = withDefaults(defineProps<{
    isOpen?: boolean
    router?: Router | null
}>(), {
    isOpen: false,
    router: null
})

// Emits
const emits = defineEmits(['close', 'open'])

// Variables
const form = ref<Router>(<Router>{})
const loading = ref<boolean>(false)

// Watchers
watch(() => props.router, (router) => {
    if (router) {
        form.value = router
    }
})

// Functions
const submit = async () => {
    if(props.router)
    {
        const {loading: ld, response} = await useFetch(route('routers.update', props.router.id), 'PUT', form.value)
        loading.value = ld.value
    }else{
        const {loading: ld, response} = await useFetch(route('routers.store'), 'POST', form.value)
        loading.value = ld.value
    }
    emits('close')
}
</script>

<template>
    <Dialog :open="isOpen">
        <DialogTrigger as-child>
            <Button @click.prevent="$emit('open')">
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
                    <Input type="text" v-model="form.ipAddress" class="" placeholder="192.168.11.1" autocomplete
                           autofocus/>
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
                <Button type="button" @click.prevent="submit">
                    <span v-if="!loading">
                        {{ props.router ? 'Update' : 'Save'}}
                    </span>
                    <Loader v-else/>
                </Button>
                <DialogClose>
                    <Button variant="destructive" @click.prevent="$emit('close')">
                        Close
                    </Button>
                </DialogClose>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
