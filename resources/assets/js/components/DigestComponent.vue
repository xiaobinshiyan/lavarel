<style scoped>
    .well {
        padding: 12px;
        margin-bottom: 15px;
    }
    .well p {
        margin: 0;
        line-height: 1.5;
    }
</style>
<template>
<div id='appw'>
      <div style="text-align: center">
          <p>
          <h3>{{book_info.name}}</h3></p>
          <p>{{book_info.author}}</p>
          <p><i>阅读量：{{book_info.clicks}}&nbsp;&nbsp;&nbsp;&nbsp;创建时间：{{book_info.created_at.split(" ")[0]}}</i></p>
      </div>
      <div class="well" v-for="row in lists">
          <p>{{row.id}}. &nbsp;{{row.content}}</p>
          <p style="text-align: right">{{row.created_at}} &nbsp;&nbsp;
          &nbsp;&nbsp;<a href="digest_edit.html"><span class="glyphicon glyphicon-pencil"></span></a>
          &nbsp;&nbsp;<a href="javascript:;" v-on:click="deletes(row.id)"><span class="glyphicon glyphicon-trash"></span></a></p>
      </div>
      <template v-if="nolist == 0">
        <ul class="list-group">
           <li class="list-group-item">
               暂无文章，去添加一个吧
           </li>
        </ul>
      </template>
    <div class="col-sm-12 text-right">
      <a href="/book" class="btn btn-success">返回</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="/book/bookadd" class="btn btn-success">添加</a>
    </div>  
   </div>
</template>

<script>
    export default {
      data () {
        return {
          lists: [],
          book_info: [],
          nolist: 1
        };
      },
      created() {
         // 获取路由参数id
        this.getBookInfo(book_id);
        this.getDigestList(book_id);
         
      },
      methods: {
            getBookInfo(id) {
              let that = this;
              axios.get('/api/book/bookinfo/' + id).then(function(response){
                that.book_info = response.data;
              })
            },
            deletes(id) {
              var that = this;
              if(confirm('确定要删除吗')==true){
                axios.get('/api/digest/delete/' + id).then(function(response){
                    var index = that.lists.findIndex(item =>{
　　　　　　　　　　　　  if(item.id == id){
　　　　　　　　　　　　    return true
　　　　　　　　　　　　  }
　　　　　　　　　　　　})
                    that.lists.splice(index,1)
                 });
              }
            },
            getDigestList(id) {
              var that = this;
              axios.get('/api/digest/digests/' + id).then(function(response){
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