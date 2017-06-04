<template>
    <div>
    <div id="" class="">
        <div class="" style="padding: 60px 6px;"> 
            <div>发布者管理</div>  
        </div>
        <div>
            <!--<router-view></router-view>-->
        </div>
    </div>
    </div>
</template>

<script>
// import axios from 'axios'
export default {
  // name: 'hello',
  data () {
    return {
      http: 'http://10.30.29.238',
      item: {
        // title: 'hhh',
        // notice: 'ifhksh',
        // time: '535'
      }
    }
  },
  mounted () {
    document.title = '后台管理'
  },
  created: function () {
    this.getDetail()
  },
  methods: {
    getDetail () {
      let self = this
      let nid = self.$route.params.id
      let formData = new FormData()
      formData.append('nid', nid)
    //   fetch(self.http + '/my-project/static/php/detail.php', {
    //     method: 'POST',
    //     body: formData
    //       // mode: 'no-cors',
    //       // headers: { 'Content-Type': 'application/json' },
    //       // credentials: 'same-origin'
    //   })
    //   .then(res => res.json())
    //   .then(function (res) {
    //     self.item = res
    //   })
    //   let request = new XMLHttpRequest()
    //   request.open('POST', self.http + '/my-project/static/php/admin.php', true) // false（同步）
    //   request.send(formData)
    //   request.onload = function () {
    //     if (request.status >= 200 && request.status < 400) {
    //       // Success!
    //       let data = JSON.parse(request.responseText)
    //       self.item = data
    //       // self.showNotice = Object.assign(self.showNotice, data)
    //       // debugger
    //       // console.log(length);
    //     } else {
    //       // 服务器返回出错
    //     }
    //   }
    //   request.onerror = function () {
    //     // 连接错误
    //   }
    //   console.log(nid)
    }
  },
  watch: {
    // select: 'getNotices'
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
