<template>
    <div>
    <div id="" class="" class="body">
        <div class="" style=""> 
            <!--<div>发布者管理</div>  -->
        </div>
        <div>
            <table>
              <th><td>默认发布者</td>
              <td></td></th>
              <tr>
                <transition name="bounce">
                <td v-if="show">{{ item.an_name }}</td>
                </transition>
                <transition name="bounce">
                <td v-if="!show"><input v-focus class="input" style="" v-model="input" /></td>
                </transition>
                <td v-if="show"><button @click="show = !show,input=item.an_name" class="btn">修 改</button></td>
                <td v-else><button @click="editAnn()" class="btn">修 改</button><button @click="show = !show,input=item.an_name" class="btn">取 消</button></td>
              </tr>
            </table>
            <!--<div class="an-name">{{ item.an_name }}</div>-->
            <!--<span class="edit">修 改</span>-->
        </div>
    </div>
    </div>
</template>

<script>
// import axios from 'axios'
export default {
  directives: {
    focus: {
      // 指令的定义---
      inserted: function (el) {
          // 聚焦元素
        el.focus()
      }
    }
  },
  // name: 'hello',
  data () {
    return {
      http: 'http://10.30.29.184/my-project/',
      show: true,
      input: '',
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
    this.getAnn()
  },
  methods: {
    getAnn () {
      let self = this
      let request = new XMLHttpRequest()
      request.open('POST', self.http + 'static/php/getann.php', true) // false（同步）
      request.send()
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
          self.item = data
          // self.input = data.an_name
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
    },
    editAnn () {
      let self = this
      let formData = new FormData()
      formData.append('an_name', self.input)
      let request = new XMLHttpRequest()
      request.open('POST', self.http + 'static/php/editann.php', true)
      request.send(formData)
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          let data = JSON.parse(request.responseText)
          if (data.status === 1) {
            self.item.an_name = data.an_name
            self.show = !self.show
            self.$message.success('修改成功')
          } else {
            self.$message.error('修改失败')
          }
          // debugger
        } else {
          // 服务器返回出错
        }
      }
      request.onerror = function () {
        // 连接错误
      }
    }
  },
  watch: {
    // select: 'getNotices'
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.body {
  padding: 60px 8px 12px 8px;
  font-size: 16px;
}
td {
  padding: 2px 4px;
}
.input {
  font-size: 14px;
  padding: 4px 6px;
  border: 1px solid #aaa;
  border-radius: 3px;
  width: 150px;
}
.btn {
  font-size: 14px;
  padding: 4px 6px;
  margin: 0 5px;
}
.bounce-enter-active {
  animation: bounce-in .5s;
}
.bounce-leave-active {
  animation: bounce-out .5s;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes bounce-out {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(0);
  }
}
</style>
