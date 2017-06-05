<template>
  <div class="home">
    <nav class="nav">
      <div class="navb title">选择小区</div>
      <div class="navb select"><select id="select" v-model="select">
        <option v-for="item in options" :value="item.aid"><span>{{ item.aname }}</span></option>
        </select></div>
    </nav>
    <div id="notice" class="notices">
      <div v-for="item in showNotice" class="notice">
      <div @click="editNotice = item, dialog4 = true">
        <h3>{{ item.title }}{{ item.nid }}</h3>
        <!--<article>{{ item.notice }}</article>-->
        <div class="time">{{ item.time }}</div>
      </div>
      </div>
    </div>
    <button class="load-more" v-if="more" @click="load_more(more)">加载更多</button>
    <el-dialog
    title=""
    :visible.sync="dialog4"
    size="large">
    <div align="">
        <div id="" class="detail">
          <div style="text-align: center">
              <div class="title">{{ editNotice.title }}</div>
              <div style="color: #888;padding-bottom:18px;">有效期: {{ editNotice.starttime }}~{{ editNotice.endtime }}</div>
          </div>
          <div class="user">尊敬的业主（用户）：</div>
          <div class="notice" v-html="editNotice.notice"></div>
          <div style="text-align: right">
          <div class="announcer">{{ editNotice.an_name }}</div>
          <div class="time">{{ editNotice.time }}</div>
          </div>
      </div>
    </div>
    <span slot="footer" class="dialog-footer-del">
        <button @click="dialog4 = false, delNotice(editNotice)">删 除</button>
        <button class="" @click="dialog4 = false, edit(editNotice)">修 改</button>
    </span>
    </el-dialog>
  </div>
</template>

<script>
// import axios from 'axios'
export default {
  // name: 'hello',
  data () {
    return {
      http: 'http://10.30.29.184/my-project/',
      select: '',
      options: [],
      showNotice: [],
      more: '',
      dialog4: false,
      editNotice: ''
    }
  },
  mounted () {
    document.title = '小区通知'
  },
  created: function () {
    this.getArea()
    this.getNotices()
  },
  methods: {
    getArea () {
      let self = this
      // axios.post('http://localhoststatic/php/area.php', {
      // })
      // .then(res => res.json())
      // .then(function (res) {
      //   self.options = res
      //   console.log(res)
      //   debugger
      // })
      // .catch(function (err) {
      //   console.log(err)
      // })
      let request = new XMLHttpRequest()
      request.open('GET', self.http + 'static/php/area.php', true) // false（同步）
      request.send()
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
          self.options = data
          for (let i = 0; i < 1; i++) {
            self.select = data[i].aid
          }
          // console.log(data)
        } else {
          // 服务器返回出错
        }
      }
      request.onerror = function () {
        // 连接错误
      }
      // fetch(self.http + '/camU/index/index/getpins1', {
      //     method: 'POST',
      //     body: formData
      //     // mode: 'no-cors',
      //     // headers: { 'Content-Type': 'application/json' },
      //     // credentials: 'same-origin'
      // })
      // .then(res => res.json())
      // .then(function (res) {
      //   self.options = res
      // })
    },
    getNotices () {
      let self = this
      let formData = new FormData()
      if (self.select) {
        // self.select = 1
        formData.append('aid', self.select)
        let request = new XMLHttpRequest()
        request.open('POST', self.http + 'static/php/notice.php', true) // false（同步）
        request.send(formData)
        request.onload = function () {
          if (request.status >= 200 && request.status < 400) {
            // Success!
            let data = JSON.parse(request.responseText)
            self.showNotice = data
            let len = data.length
            if (len >= 10) {
              for (let i = 9; i < 10; i++) {
                self.more = data[i].nid
              }
            } else {
              self.more = ''
            }
            // console.log(length)
          } else {
            // 服务器返回出错
          }
        }
        request.onerror = function () {
          // 连接错误
        }
      }
      // console.log(self.select)
    },
    load_more (e) {
      let self = this
      let formData = new FormData()
      formData.append('aid', self.select)
      formData.append('nid', e)
      let request = new XMLHttpRequest()
      request.open('POST', self.http + 'static/php/getmore.php', true) // false（同步）
      request.send(formData)
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
          let len = data.length
          if (len >= 10) {
            for (let i = 0; i < 10; i++) {
              // self.showNotice.push(data[i])
              self.more = data[i].nid
            }
          } else {
            self.more = ''
          }
          self.showNotice = self.showNotice.concat(data)
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
      console.log(e)
    },
    delNotice (e) {
      let self = this
      self.$message.info('暂不可删除')
    },
    edit (e) {
      let self = this
      self.$message.info('暂不可修改')
    }
  },
  watch: {
    select: 'getNotices'
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.home {
  background: #eee;
}
.nav {
  width: 100%;
  position: fixed;
  background-color: #fff;
  /*height: 50px;*/
  font-size: 16px;
  line-height: 24px;
  top: 60px;
  border-bottom: 2px solid #ddd;
}
.nav .navb {
  padding: 8px 8px;
  display: inline-block;
  /*vertical-align: middle;*/
}
.select {
  float: right;
}
.select select {
  border: none;
  width: 160px;
  padding: 0 40px 0 2px;
  font-size: 16px;
}
.notices {
  padding-top: 108px;
  font-size: 18px;
  outline: medium none;
}
.notice {
  margin-bottom: 8px;
  padding: 18px 5px;
  background-color: #fff;
}
.time {
  padding-top: 12px;
  font-size: 16px;
}
.load-more {
  padding: 12px 6px;
  width: 100%;
  margin-top: 5px;
  margin-bottom: -1px;
}
.dialog-footer-del button {
    margin-left: 30px;
    padding: 5px 15px;
    border-radius: 3px;
    display: inline;
    background: #bbb;
}
</style>
