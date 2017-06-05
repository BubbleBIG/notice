<template>
    <div>
    <div id="" class="" align="center">
        <div class="area-contro" style=""> 
            <div>小区名字管理</div>
        </div>
        <div align="center" class="add-btn">
            <button @click="dialog1 = true" class="btn">添 加</button>
        </div>
        <div class="area-list">
          <table>
            <tr v-for="(item, index) in areaList">
                <!--<div class="area-common">{{ index }}</div>-->
                <td class="area-common">{{ item.aname}}</td>
                <td class="edit-btn"><button @click="editOne = Object.assign({}, item),
                dialog2 = true" class="btn">编 辑</button></td>
            </tr>
          </table>
        </div>
        <div style=" clear:both;height: 40px;"></div>
    </div>
    <el-dialog
    title="新 增"
    :visible.sync="dialog1"
    size="full">
    <div align="center">
        <span style="display:inline;padding-right:15px;">小区名</span>
        <input class="add-input" v-model="input1" placeholder="请输入内容"/>
    </div>
    <span slot="footer" class="dialog-footer-add">
        <button @click="dialog1 = false">取 消</button>
        <button class="save-btn" @click="addArea()">确 定</button>
    </span>
    </el-dialog>
    <el-dialog
    title="编 辑"
    :visible.sync="dialog2"
    size="full">
    <div align="center">
        <span style="display:inline;padding-right:15px;">小区名</span>
        <input class="add-input" v-model="editOne.aname" placeholder="请输入内容"/>
    </div>
    <span slot="footer" class="dialog-footer-add dialog-footer-edit">
        <button @click="dialog3 = true">删 除</button>
        <button @click="dialog2 = false">取 消</button>
        <button class="" @click="editArea(editOne)">确 定</button>
    </span>
    </el-dialog>
    <el-dialog
    title="删 除"
    :visible.sync="dialog3"
    size="large">
    <div align="center">
        <span>确定删除?</span>
    </div>
    <span slot="footer" class="dialog-footer-del">
        <button @click="dialog3 = false">取 消</button>
        <button class="" @click="delArea(editOne.aid)">确 定</button>
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
      areaList: [],
      dialog1: false,
      dialog2: false,
      dialog3: false,
      editOne: [],
      input1: '',
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
    //   let nid = self.$route.params.id
    //   let formData = new FormData()
    //   formData.append('nid', nid)
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
      request.open('POST', self.http + 'static/php/area.php', true) // false（同步）
      request.send()
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
          // Success!
          let data = JSON.parse(request.responseText)
          self.areaList = data
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
    },
    addArea () {
      let self = this
      let formData = new FormData()
      if (self.input1) {
        formData.append('aname', self.input1)
        let request = new XMLHttpRequest()
        request.open('POST', self.http + 'static/php/addarea.php', true) // false（同步）
        request.send(formData)
        request.onload = function () {
          if (request.status >= 200 && request.status < 400) {
            // Success!
            let data = JSON.parse(request.responseText)
            if (parseInt(data.status) === 1) {
              self.areaList = self.areaList.concat(data.data)
              self.dialog1 = false
              self.$message.success('添加成功')
            } else if (parseInt(data.status) === 2) {
              self.$message.error('名字重复')
            } else {
              self.$message.error('添加失败')
            }
            self.input1 = ''
          } else {
          // 服务器返回出错
          }
        }
        request.onerror = function () {
        // 连接错误
        }
      } else {
        self.$message.error('输入不为空')
      }
    },
    editArea (e) {
      let self = this
      if (e.aname) {
        let formData = new FormData()
        formData.append('aid', e.aid)
        formData.append('aname', e.aname)
        let request = new XMLHttpRequest()
        request.open('POST', self.http + 'static/php/editarea.php', true) // false（同步）
        request.send(formData)
        request.onload = function () {
          if (request.status >= 200 && request.status < 400) {
            // Success!
            let data = JSON.parse(request.responseText)
            if (parseInt(data.status) === 1) {
              self.areaList = data.data
              self.dialog2 = false
              self.$message.success('修改成功')
            } else if (parseInt(data.status) === 2) {
              self.$message.error('名字重复')
            } else {
              self.$message.error('修改失败')
            }
          } else {
          // 服务器返回出错
          }
        }
        request.onerror = function () {
        // 连接错误
        }
      } else {
        self.$message.error('输入不为空')
      }
    },
    delArea (e) {
      let self = this
      let formData = new FormData()
      formData.append('aid', e)
      let request = new XMLHttpRequest()
      request.open('POST', self.http + 'static/php/delarea.php', true) // false（同步）
      request.send(formData)
      request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
        // Success!
          let data = JSON.parse(request.responseText)
          if (parseInt(data.status) === 1) {
            self.areaList = data.data
            self.dialog3 = false
            self.dialog2 = false
            self.$message.success('删除成功')
          } else {
            self.$message.error('删除失败')
          }
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
.area-contro {
    font-size: 16px;
    padding: 60px 0 15px 0;
    text-align: center;
}
.add-btn button{
    padding: 5px 0;
    width: 50%;
}
.area-list {
    padding: 10px 30px;
    font-size: 16px;
    /*width: 50%;*/
}
.area-list td {
  width: 200px;
  padding: 5px 8px;
  text-align: center;

}
/*.area-list .area-common {
    padding: 8px 0;
    float: left;
    clear: both;
}
.edit-btn {
    float: right;
    margin-top: 1px;
}*/
.btn {
    padding: 2px 10px;
    font-size: 16px;
}
.dialog-footer-add {
    /*text-align: center;*/
}
.dialog-footer-add button {
    padding: 5px 15px;
    border-radius: 3px;
    display: inline;
    background: #bbb;
}
.dialog-footer-add .save-btn {
    margin-left: 30px;
}
.dialog-footer-edit button {
    margin-left: 20px;
}
.dialog-footer-del {

}
.dialog-footer-del button {
    margin-left: 30px;
    padding: 5px 15px;
    border-radius: 3px;
    display: inline;
    background: #bbb;
}
.add-input {
    padding: 3px 8px;
    border-radius: 3px;
    border: 1px solid #bbb;
}
</style>
