import axios from "axios";
import {toast} from "vue-sonner";
import {ref} from "vue";

export const useFetch = async <RequestData, ResponseData>(url: string, method: string = "GET", body: RequestData = {} as RequestData , options: {} = {}) => {
    let loading = ref<boolean>(false)
    let response = ref<ResponseData | null>(null)
    try {
        loading.value = true
        const {data, status} = await axios({
            method: method,
            url: url,
            data: body,
            ...options
        })
        response.value = data
        toast.success(data.message as string)
    }catch (e: any) {
        if (e.response && e.response.data && e.response.data.errors) {
            for (const field in e.response.data.errors) {
                for (const error of e.response.data.errors[field]) {
                    toast.error(error);
                }
            }
        } else {
            toast.error('An fatal error Occurred!! Please try again later')
        }
    }finally {
        loading.value = false
    }
    return {
        loading,
        response
    }
}
