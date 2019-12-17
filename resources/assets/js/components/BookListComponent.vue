<style scoped>
   .digest_count{
      float:right;
      width:70px;
   }
   .list-group-item{
   margin-bottom:0;
   }
</style>

<template>
<div id='appw'>
   <div class="text-center"><h2>读书笔记</h2></div>
   <div class="col-sm-12">
   	<div class="list-group">
      <template v-for="row in lists">
        <!-- <router-link :to="`/digest/${row.id}`"> -->
   		     <a  v-bind:href="row.href" class="list-group-item" v-on:click="increase(row.id)">
            {{row.name}}
            <span class="digest_count">笔记：{{row.num}}</span>
          </a>
        <!-- </router-link> -->
      </template>
      <template v-if="nolist == 0">
        <ul class="list-group">
           <li class="list-group-item">
               暂无书目，去添加一个吧
           </li>
        </ul>
      </template>
   	</div>
   </div>
   <div class="col-sm-12 text-right">
   	<a href="/book/create" class="btn btn-success">添加</a>
   </div> 
   </div>
</template>

<script>
    export default {
      data () {
        return {
          lists: [],
          nolist: 1
        };
      },
      created() {
         // 获取路由参数id
         // var id = this.$route.params.id;
         this.getBookList();
      },
      methods: {
            increase(id) {
              axios.get('/api/book/click/' + id)
            },
            getBookList() {
              var that = this;
              axios.get('api/book/bookList').then(function(response){
                // console.log(response.data)
                that.lists = response.data;
                if (that.lists.length == 0) {
                  that.nolist = 0;
                }
              })
            }
      }
    }
</script>