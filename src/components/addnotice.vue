<template>
  <div class="add-notice-body">
  <div>
    <div>
      <input class="title" v-model="title" placeholder="标题" />
      <div>有效期：</div>
      <div>
        <el-date-picker
        v-model="value1"
        type="date"
        placeholder="选择日期"
        :picker-options="pickerOptions0">
        </el-date-picker>
        <el-date-picker
        v-model="value2"
        type="date"
        placeholder="选择日期"
        :picker-options="pickerOptions0">
        </el-date-picker>
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
  <button>保存</button>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        pickerOptions0: {
          disabledDate (time) {
            return time.getTime() < Date.now() - 8.64e7
          }
        },
        title: '',
        value1: '',
        value2: '',
        content: '',
        editorOption: {}
      }
    },
    methods: {
      onEditorBlur (editor) {
        // console.log('editor blur!', editor)
      },
      onEditorFocus (editor) {
        // console.log('editor focus!', editor)
      },
      onEditorReady (editor) {
        // console.log('editor ready!', editor)
      }
    },
    computed: {
      editor () {
        return this.$refs.myTextEditor.quillEditor
      }
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
  padding: 5px 12px;
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
</style>
