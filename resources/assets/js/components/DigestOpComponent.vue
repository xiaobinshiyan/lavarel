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
    <h2>读书笔记操作</h2>
  </div>
   <!--创建成功显示消息-->
  <div class="alert alert-success" v-if="submitted">
    操作成功!
  </div>
  <form class="form-horizontal" role="form" @submit.prevent="bookAdd($event)" method="post">
      <div class="form-group">
      <div class="col-sm-12">
        <!-- <input class="form-control" id="disabledInput" name='book_id' type="text" value="{{info.name}}" disabled> -->
        <div class="form-group">
            <div class="col-sm-12">
<!--               <select class="form-control" name="bookid">
                <option selected="selected" :value="info.book_id">{{info.name}}</option>
              </select> -->
              <select class="form-control" name="bookid" v-model="book_selected" @change="getBookSelect">
                <option v-for="item in lists" :value="item.id">{{item.name}}</option>
              </select>
            </div>
        </div>
      </div>
      </div>
      <div class="form-group">
          <div class="col-sm-12">
              <textarea class="form-control" rows="8" name="content" placeholder="填写内容">{{info.content}}</textarea>
              <span class="help-block" v-if="errors.author">
                  {{errors.author.join(',')}}
              </span>
          </div>
      </div>
      <div class="form-group">
          <div class="col-sm-12 text-center">
              <input type="hidden" name="digest_id" v-model="digest_id">
              <input type="button" class="btn btn-info" @click="goback" value="返回"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="button" class="btn btn-warning" @click="resetField"  value="重置"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
          info: {
            name:'',
            content:'',
            book_id:''
          },
          digest_id: digest_id,
          errors: [],
          lists:[],
          submitted: false,
          book_selected:''
        };
      },
      created() {
        if (this.digest_id != 0) {
          this.getDigestInfo();
        }
        this.getBookInfo();
        // this.book_selected = this.info.book_id;
        // console.log(this.book_selected)
      },
      methods: {
            getDigestInfo() {
              var that = this;
              axios.get('/api/digest/digestinfo/' + that.digest_id).then(function(response){
                // console.log(response.data)
                that.info = {
                  name:response.data[0].name,
                  content:response.data[0].content,
                  book_id: response.data[0].book_id
                };
                that.book_selected = that.info.book_id;
              })
            },
            getBookInfo() {
              var that = this;
              axios.get('/api/book/bookList').then(function(response){
                that.lists = response.data;
                // console.log(that.lists[0].book_id)
                if (that.digest_id == 0) {
                  that.book_selected = that.lists[0].id;
                  that.$set(that.info,'book_id',that.lists[0].id)
                }
              })
            },
            getBookSelect() {
              this.$set(this.info,'book_id',this.book_selected)
            },
            bookAdd(event) {
              var that = this;
              var formData = new FormData(event.target);
              axios.post('/api/digest/save', formData).then(function(response) {
                that.errors = '';
                that.submitted = true;
                setTimeout(function(){
                  window.location.href = "/digest/" + that.info.book_id
                }, 1000);
              }).catch(function (error) {
                that.errors = error.response.data.errors;
              });
            },
            goback() {
              window.location.href = "/digest/" + this.info.book_id
            },
            resetField() {
              this.$set(this.info,'content','')
            }
      }
    }
</script>