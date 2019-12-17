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
  <div class="text-center" style="margin:10px 0">
    <h2>书目添加</h2>
  </div>
   <!--创建成功显示消息-->
  <div class="alert alert-success" v-if="submitted">
    操作成功!
  </div>
  <form class="form-horizontal" role="form" @submit.prevent="bookAdd($event)" method="post">
      <div class="form-group">
          <div class="col-sm-12">
              <input class="form-control"  name="name" placeholder="书名" v-model="infoa.name"/>
              <span class="help-block" v-if="errors.name">
                  {{errors.name.join(',')}}
              </span>
          </div>
      </div>
    <div class="form-group">
          <div class="col-sm-12">
              <input class="form-control"  name="author" placeholder="作者" v-model="infoa.author"/>
              <span class="help-block" v-if="errors.author">
                  {{errors.author.join(',')}}
              </span>
          </div>
      </div>
    <div class="form-group">
          <div class="col-sm-12">
              <input class="form-control"  name="sort" placeholder="排序" v-model="infoa.sorta"/>
              <span class="help-block" v-if="errors.sorta">
                  排序请正确书写
              </span>
          </div>
      </div>
      <div class="form-group">
          <div class="col-sm-12 text-center">
              <input type="hidden" name="book_id" v-model="book_id">
              <input type="button" class="btn btn-info" @click="history" value="返回"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="button" class="btn btn-warning" @click="resetField" value="重置"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" class="btn btn-success" value="提交"/>
          </div>
      </div>
  </form>
</div>
</template>

<script>
    export default {
      data () {
        return {
          infoa: [],
          nolist: 1,
          book_id: book_id,
          errors: [],
          submitted: false
        };
      },
      created() {
         if (this.book_id != 0) {
            this.getBookInfo();
         }
      },
      methods: {
            getBookInfo() {
              var that = this;
              axios.get('/api/book/bookinfo/' + book_id).then(function(response){
                // console.log(response.data)
                that.infoa = {
                  name:response.data.name,
                  author:response.data.author,
                  sorta:response.data.sort
                };
              })
            },
            bookAdd(event) {
              var that = this;
              var formData = new FormData(event.target);
              axios.post('/api/book/save', formData).then(function(response) {
                that.infoa = {
                  title: '',
                  body: '',
                };
                that.errors = '';
                that.submitted = true;
                setTimeout(function(){
                  window.location.href = "/book"
                }, 1000);
              }).catch(function (error) {
                that.errors = error.response.data.errors;
                that.errors.sorta = error.response.data.errors.sort
              });
            },
            history() {
              window.location.href = "/book"
            },
            resetField() {
              this.infoa = {
                name:'',
                author:'',
                sorta: ''
              }
            }
      }
    }
</script>