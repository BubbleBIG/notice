<template>
  <div class="add-notice-body">
  <div>
    <div>
      <input class="title" v-model="title" placeholder="标题" />
      <div>有效期：</div>
      <div style="padding-bottom:8px;">
        <el-date-picker
        v-model="value1"
        type="date" 
        placeholder="选择起始日期">
        </el-date-picker>
        <el-date-picker
        v-model="value2"
        format="yyyy-MM-dd"
        type="date"
        placeholder="选择结束日期">
        </el-date-picker>
      </div>
      <div style="padding-bottom:8px;">
      <div>小区选择：</div>
      <el-select v-if="!selectAll" v-model="select" multiple placeholder="请选择小区(可多选)">
        <el-option
        v-for="item in areaList"
        :label="item.aname"
        :value="item.aid">
        </el-option>
      </el-select>
      <el-checkbox v-model="selectAll">全选</el-checkbox>
      </div>
      <div id="" class="quill-editor-example">
        <!-- quill-editor -->
        <!--<quill-editor ref="myTextEditor"
            v-model="content"
            :options="editorOption"
            @blur="onEditorBlur($event)"
            @focus="onEditorFocus($event)"
            @ready="onEditorReady($event)">
        </quill-editor>-->
        <quill-editor id="quill-editor-example" ref="myTextEditor"
            v-model="content"
            :options="editorOption"
            @blur="onEditorBlur($event)">
        </quill-editor>
        
        <div class="html ql-editor" v-html="content"></div>
      </div>
    </div>
  </div>
  <div class="save-btn" align="right">
  <button @click="save()">保 存</button>
  </div>
  </div>
</template>

<script>
  var moment = require('moment')
  export default {
    data () {
      return {
        http: 'http://10.30.29.184/my-project/',
        pickerOptions0: {
        //   disabledDate (time) {
        //     return time.getTime() < Date.now() - 8.64e7
        //   }
        },
        title: '',
        value1: '',
        value2: '',
        areaList: '',
        select: '',
        selectAll: false,
        content: '',
        editorOption: {}
      }
    },
    created: function () {
      this.getArea()
    },
    methods: {
      getArea () {
        let self = this
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
            console.log(self.areaList)
          } else {
            // 服务器返回出错
          }
        }
        request.onerror = function () {
            // 连接错误
        }
      },
      save () {
        let self = this
        let formData = new FormData()
        if (self.title) {
          formData.append('title', self.title)
          if (self.value1 && self.value2) {
            let va1 = moment(this.value1).format('YYYY-MM-DD')
            let va2 = moment(this.value2).format('YYYY-MM-DD')
            formData.append('starttime', va1)
            formData.append('endtime', va2)
            if (self.selectAll) {
              formData.append('select', 0)
            } else {
              if (self.select === null) {
                self.$message.error('小区不能为空')
                // console.log(self.select)
              } else {
                formData.append('select', self.select)
                // console.log(formData)
              }
            }
            if (self.content) {
              formData.append('notice', self.content)
              let request = new XMLHttpRequest()
              request.open('POST', self.http + 'static/php/admin.php', true) // false（同步）
              request.send(formData)
              request.onload = function () {
                if (request.status >= 200 && request.status < 400) {
                  // Success!
                  let data = JSON.parse(request.responseText)
                  if (data.status === 1) {
                    self.$message.success('保存成功')
                    setTimeout(() => {
                      location.reload('/admin/addnotice/') // 重新加载页面
                        // self.$router.push('/' + res.name + '/')
                    }, 800)
                  } else {
                    self.$message.error('保存失败')
                  }
                //   self.data = data
                  // self.showNotice = Object.assign(self.showNotice, data)
                  // debugger
                  //   console.log(formData)
                } else {
                // 服务器返回出错
                }
              }
              request.onerror = function () {
              // 连接错误
              }
            } else {
              self.$message.error('通知内容不能为空')
            }
          } else {
            self.$message.error('起始或终止时间不能为空')
          }
        } else {
          self.$message.error('标题不能为空')
        }
      },
      onEditorBlur (editor) {
        // console.log('editor blur!', editor)
        if (!this.content) {
          this.$message.error('通知内容不为空')
        }
        let a = moment(this.value2).format('YYYY-MM-DD')
        console.log(a)
        // console.log(this.value2)
        // console.log(this.select)
      }
    },
    computed: {
      editor () {
        return this.$refs.myTextEditor.quillEditor
      }
    },
    watch: {
    },
    mounted () {
    //   console.log('this is my editor', this.editor)
    //   setTimeout(() => {
    //     this.content = '<h1>Example 1 changed!</h1>'
    //   }, 1800)
    }
  }
</script>

<style scoped>
.add-notice-body {
  padding: 66px 12px 30px 12px;
  background: #fff;
}
.title {
  padding: 8px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin: 10px 0;
  width: 80%;
}
/*.ql-container .ql-editor {
  min-height: 20em;
  padding-bottom: 1em;
  max-height: 25em;
  overflow-y: auto;
}*/
.html {
  height: 10em;
  overflow-y: auto;
  border: 1px solid #ccc;
  border-top: none;
  resize: vertical;
}
.save-btn {
  padding: 15px 6px;
}
.save-btn button {
  background: #ddd;
  padding: 6px 13px;
  font-size: 16px;
  border-radius: 3px;
}
</style>
