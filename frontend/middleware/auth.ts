export default defineNuxtRouteMiddleware((to, from) => {
    const token = useCookie("token");
    const user = useCookie("user");

    // must validate token in backend to ensure redirect

    if(token.value){
        console.log(to,from)
    }else{
        const router = useRouter();
        router.push({ path: "/register" });
    }

    console.log(token,user,'Auth middleware');

})