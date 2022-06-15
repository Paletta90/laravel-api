<template>
    <div>
        <Header />

        <main>
            <ListPosts />
        </main>
    </div>
</template>

<script>

    import Header from './posts/Header.vue'
    import ListPosts from './posts/ListPosts.vue'

    export default {
        name: "App",
        components:{
            Header,
            ListPosts
        }
    }
</script>