<template>
    <div>
    <div id="" class="">
        <div class="fix header" style="text-align: center">
            <div class="menu-img" style=""><button @click="show = !show"><span>
                <img src="../../static/img/menu.png" width="28" height="28"/></span></button></div>
            <h3>后台管理</h3>
        </div>
        <transition name="slide-fade">
        <div v-if="show" class="fix sidebar">
            <div class="sidebar-link" @click="show = false"><router-link to="/admin/area/">小区名字管理</router-link></div>
            <div class="sidebar-link" @click="show = false"><router-link to="/admin/addnotice/">编写新通知</router-link></div>
            <div class="sidebar-link" @click="show = false"><router-link to="/admin/notice/">通知内容管理</router-link></div>
            <div class="sidebar-link" @click="show = false"><router-link to="/admin/announcer/">发布者管理</router-link></div>
        </div>
        </transition>
        <div @click="show = false">
            <router-view></router-view>
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
      show: false,
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
    //   let request = new XMLHttpRequest()
    //   request.open('POST', self.http + 'static/php/admin.php', true) // false（同步）
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
.fix {
    position: fixed;
}
.header {
    width: 100%;
    background: #bbb;
    padding: 20px 5px;
    z-index: 99;
}
.menu-img {
    position: absolute;
    top: 10px;
    left: 12px;
}
.menu-img button {
    background: #bbb;
}
.sidebar {
    height: 100%;
    /*width: 160px;*/
    background: #fff;
    padding: 60px 60px 10px 20px;
    overflow-x: hidden;
    overflow-y: auto;
    z-index: 98;
}
.slide-fade-enter-active {
  transition: all .5s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(0.4, 0, 0, 1);
}
.slide-fade-enter, .slide-fade-leave-active {
  transform: translateX(-5px);
  opacity: 0;
}
.sidebar-link {
  padding: 6px 2px;
  font-size: 16px;
}
a.router-link-active {
    padding-bottom: 1px;
  border-bottom: 2px solid #fab;
}
/*@media screen and (max-width: 900px) {
.sidebar {
    transition: all 0.4s cubic-bezier(0.4, 0, 0, 1);
    -webkit-transform: translate(-180px, 0);
    transform: translate(-180px, 0);
}
}*/
</style>
