<template>
    <div>
    <div id="" class="detail">
        <div style="text-align: center">
            <div class="title">{{ item.title }}</div>
            <div style="color: #888;padding-bottom:18px;">有效期: {{ item.starttime }}~{{ item.endtime }}</div>
        </div>
        <div class="user">尊敬的业主（用户）：</div>
        <div class="notice" v-html="item.notice"></div>
        <div style="text-align: right">
        <div class="announcer">{{ item.an_name }}</div>
        <div class="time">{{ item.time }}</div>
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
      http: 'http://10.30.29.184/my-project/',
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
    //   fetch(self.http + 'static/php/detail.php', {
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
      request.open('POST', self.http + 'static/php/detail.php', true) // false（同步）
      request.send(formData)
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
        //   let reg = /"\d+"/g
        //   data.notice = data.notice.substring(0)
        //   data.notice = data.notice.split('').reverse().join('')
        //   data.notice = data.notice.substring(0)
        //   data.notice = data.notice.split('').reverse().join('')
          data.notice = data.notice.replace(/<p>/g, '<p>&nbsp;&nbsp;&nbsp;')
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
.detail {
  height: 100%;
  padding: 20px 10px 16px 10px;
  line-height: 1.5;
}
.title {
  font-size: 16px;
  padding-bottom: 14px;
}
.user {
  font-size: 14px;
  line-height: 16px;
  padding-bottom: 6px;
}
.notice {
  padding: 3px 0;
  font-size: 14px;
}
.announcer, .time {
  font-size: 14px;
}
.announcer {
  padding-top: 5px;
}
</style>

