<template>

    <div>

        <div class="container">

            <div class="row">

                <div v-for="post in posts" :key="post.id" class="col-3">

                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Titolo: {{ post.title }}</h5>
                            <p class="card-text">Test: {{ post.content }}</p>
                            <p class="card-text">Categoria: {{ post.category.name }}</p> -->
                            <div v-for="platform in post.platforms" :key="platform.id">
                            <!-- <img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-512.png" alt="" width="20px"> -->
                                <img :src="require(platform.icon)" alt="">
                            </div>
                            <!-- <p class="card-text font-italic">Firma: {{ post.firm }}</p> -->
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>
    import axios from 'axios'

    export default {
        name: 'ListPosts',

        data(){
            return{
                posts: []
            }
        },

        methods:{
            getPosts(){
                axios.get("http://127.0.0.1:8000/api/posts")
                    .then( (res) =>{
                        // console.log(res.data.posts)
                        this.posts = res.data.posts;
                    })
            }
        },

        mounted(){
            this.getPosts();
        }
    }

</script>
