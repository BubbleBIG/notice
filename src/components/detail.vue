<template>
    <div>
    <div id="" class="">
        <div style="text-align: center">
            <h3>{{ item.title }}</h3>
            <div>有效期：{{ item.time }}~{{ item.time }}</div>
        </div>
        <article>{{ item.notice }}</article>
        <div style="text-align: right">
        <div>{{ item.title }}</div>
        <div>{{ item.time }}</div>
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
    document.title = '小区通知'
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
      let request = new XMLHttpRequest()
      request.open('POST', self.http + '/my-project/static/php/detail.php', true) // false（同步）
      request.send(formData)
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
          self.item = data
          // self.showNotice = Object.assign(self.showNotice, data)
          // debugger
          // console.log(length);
        } else {
          // 服务器返回出错
        }
      }
      request.onerror = function () {
        // 连接错误
      }
    //   console.log(nid)
    }
  },
  watch: {
    select: 'getNotices'
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>

