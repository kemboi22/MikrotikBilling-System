<script setup lang="ts">
import {Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow,} from '@/components/ui/table'
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import CreateRouterComponent from "@/Components/Router/CreateRouterComponent.vue";
import {DataResponse, Router} from "@/types";
import {Button} from "@/components/ui/button";
import {ref} from "vue";

// Props
defineProps<{
    routers: DataResponse<Router[]>
}>()

// Variables
const modalIsOpen = ref<boolean>(false)
const selectedRouter = ref<Router | null>(null)

// Functions
const closeModal = () => {
    modalIsOpen.value = false
}
const openModal = () => {
    modalIsOpen.value = true
}
const openEditModal = (router: Router) => {
    selectedRouter.value = router
    modalIsOpen.value = true
}
</script>

<template>
    <DashboardLayout>
        <div>
            <CreateRouterComponent :is-open="modalIsOpen" :router="selectedRouter" @close="closeModal"
                                   @open="openModal"/>
        </div>
        <Table>
            <TableCaption>Routers</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">
                        #ID
                    </TableHead>
                    <TableHead>Router Name</TableHead>
                    <TableHead>IP Address</TableHead>
                    <TableHead>Port</TableHead>
                    <TableHead>Username</TableHead>
                    <TableHead class="text-right">
                        Actions
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="(router, index) in routers.data" :key="router.id">
                    <TableCell class="font-medium">
                        {{ router.id }}
                    </TableCell>
                    <TableCell>{{ router.name }}</TableCell>
                    <TableCell>{{ router.ipAddress }}</TableCell>
                    <TableCell>{{ router.port }}</TableCell>
                    <TableCell>{{ router.username }}</TableCell>
                    <TableCell class="text-right flex justify-between gap-3">
                        <Button variant="secondary" @click.prevent="openEditModal(router)">Edit</Button>
                        <Button>Show</Button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </DashboardLayout>
</template>
