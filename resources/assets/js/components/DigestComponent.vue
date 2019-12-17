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
          <p><i>阅读量：{{book_info.clicks}}&nbsp;&nbsp;&nbsp;&nbsp;创建时间：{{book_info.created_at}}</i></p>
      </div>
      <div class="well" v-for="row in items">
          <p>{{row.id}}. &nbsp;{{row.content}}</p>
          <p style="text-align: right">{{row.created_at}} &nbsp;&nbsp;
          &nbsp;&nbsp;<a href="javascript:;" v-on:click="editDigest(row.id)"><span class="glyphicon glyphicon-pencil"></span></a>
          &nbsp;&nbsp;<a href="javascript:;" v-on:click="deletes(row.id)"><span class="glyphicon glyphicon-trash"></span></a></p>
      </div>
        <nav>
          <ul class="pagination">
              <li v-if="pagination.current_page > 1">
                  <a href="#" aria-label="Previous"
                     @click.prevent="changePage(pagination.current_page - 1)">
                      <span aria-hidden="true">&laquo;</span>
                  </a>
              </li>
              <li v-for="page in pagesNumber"
                  v-bind:class="[ page == isActived ? 'active' : '']">
                  <a href="#"
                     @click.prevent="changePage(page)">{{ page }}</a>
              </li>
              <li v-if="pagination.current_page < pagination.last_page">
                  <a href="#" aria-label="Next"
                     @click.prevent="changePage(pagination.current_page + 1)">
                      <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>
          </ul>
      </nav>
      <template v-if="nolist == 0">
        <ul class="list-group">
           <li class="list-group-item">
               暂无笔记，去添加一个吧
           </li>
        </ul>
      </template>
    <div class="col-sm-12 text-right">
      <a href="/" class="btn btn-success">返回</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="/digest/add/info" class="btn btn-success">添加</a>
    </div>  
   </div>
</template>

<script>
    export default {
      data () {
        return {
          pagination: {
              total: 0,
              per_page: 7,
              from: 1,
              to: 0,
              current_page: 1
          },
          offset: 4,
          items: [],
          book_info: [],
          nolist: 1,
          book_id:book_id
        };
      },
      created() {
         // 获取路由参数id
        this.getBookInfo(book_id);
        // this.getDigestList(book_id);
        this.fetchItems(this.pagination.current_page,book_id);
      },
      computed: {
          isActived: function () {
              return this.pagination.current_page;
          },
          pagesNumber: function () {
              if (!this.pagination.to) {
                  return [];
              }
              var from = this.pagination.current_page - this.offset;
              if (from < 1) {
                  from = 1;
              }
              var to = from + (this.offset * 2);
              if (to >= this.pagination.last_page) {
                  to = this.pagination.last_page;
              }
              var pagesArray = [];
              while (from <= to) {
                  pagesArray.push(from);
                  from++;
              }
              return pagesArray;
          }
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
                    var index = that.items.findIndex(item =>{
　　　　　　　　　　　　  if(item.id == id){
　　　　　　　　　　　　    return true
　　　　　　　　　　　　  }
　　　　　　　　　　　　})
                    that.items.splice(index,1)
                 });
              }
            },
            editDigest(id) {
              window.location.href = '/digest/edit/' + id;
            },
            fetchItems: function (page,id) {
                var that = this;
                var data = {page: page};
                axios.get('/api/digest/digests/' + id + '?page='+page).then(function (response) {
                    // that.$set('items', response.data.data.data);
                    that.items = response.data.data.data;
                    if (that.items.length == 0) {
                      that.nolist = 0;
                    }
                    that.pagination = response.data.pagination;
                }, function (error) {
                    // handle error
                });
            },
            changePage: function (page) {
              console.log(page)
                this.pagination.current_page = page;
                this.fetchItems(page,this.book_id);
            }
      }
    }
</script>