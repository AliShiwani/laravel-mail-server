<template>
  <main class="inbox">
    <div class="box-header with-border">
      <h3 class="box-title">Compose New Message</h3>
    </div>
    <!-- /.box-header -->
    <div class="row" style="margin-left:0px !important; margin-right:0px !important; paddin:10px;justify-content: center;margin-bottom: 10px;">
    <router-link :to="{ name: 'selectlist', params: { template: template} }"  style="margin-left:2px; margin-right:2px;" class="col-5 btn btn-purple-primary btn-block">Select Users</router-link>
    <div v-if="allemails.emails" class="col-5 btn btn-light btn-block" style="margin-left:2px; margin-right:2px;">{{ allemails.emails.length }} Selected Users</div>
    <div v-else class="col-5 btn btn-light btn-block" style="margin-left:2px; margin-right:2px;">{{ allemails.length }} Selected Users</div>
    </div>
    <div class="row" style="margin-left:0px !important; margin-right:0px !important; paddin:10px;justify-content: center;margin-bottom: 10px;">
    <form @submit.prevent="sendEmail" @keydown="form.onKeydown($event)">
      <div class="box-body">
        <div class="form-group">
          <input
            disabled
            name="to"
            v-model="form.to"
            class="form-control"
            placeholder="To:"
          />
        </div>
        <div class="form-group">
          <input
            name="subject"
            v-model="form.subject"
            class="form-control"
            placeholder="Subject:"
          />
        </div>
        <div class="form-group">
          <wysiwyg v-model="form.html" />
        </div>
        <div class="form-group">
          <div class="btn btn-default btn-file">
            <i class="fa fa-paperclip"></i> Attachment
            <input type="file" name="attachment" />
          </div>
          <p class="help-block">Max. 32MB</p>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <!-- <div class="pull-right">
          <button type="button" class="btn btn-default">
            <i class="fas fa-pencil-alt"></i> Draft
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-envelope"></i> Send
          </button>
        </div> -->

        <div class="">
          <button
            type="button"
            class="btn btn-success waves-effect waves-light me-1"
          >
            <i class="far fa-save"></i>
          </button>
          <button
            type="reset"
            class="btn btn-success waves-effect waves-light me-1"
          >
            <i class="far fa-trash-alt"></i>
          </button>
          <button type="submit" class="btn btn-primary waves-effect waves-light">
            <span>Send</span> <i class="fab fa-telegram-plane ms-2"></i>
          </button>
        </div>

        <!-- <button type="reset" class="btn btn-default">
          <i class="fas fa-times"></i> Discard
        </button> -->
      </div>
      <!-- /.box-footer -->
    </form>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      allemails: {},
      id: 0,
      template:{},
      // Create a new form instance
      form: new Form({
        id: "",
        from: "",
        subject: "",
        html: "",
        attachments: "",
      }),
      // { [module]: boolean (set true to hide) }
      hideModules: { bold: true },

      // if the image option is not set, images are inserted as base64
      image: {
        uploadURL: "/api/myEndpoint",
        dropzoneOptions: {},
      },
    };
  },

  methods: {
    sendEmail() {
      // Submit the form via a POST request
      this.form.post(Inbox.basePath + "/api/send").then(({ data }) => {
        console.log(data);
        if(data.status){
          Swal.fire({
          title: 'Error!',
          text: 'There might be issue while sending mail please check email addresses or check logs.',
          icon: 'error',
          confirmButtonText: 'OK'
          })  
        }else{
          Swal.fire({
          title: 'Sent!',
          text: 'Your Email is sent',
          icon: 'success',
          confirmButtonText: 'OK'
          })
          this.$router.push({ path: 'dashboard' });
          // alert('Sent!');
        }
      });
    },
  },
  mounted() {
      
      if(this.$route.params.template.subject){
        this.allemails.emails = this.$route.params.emails;
        this.allemails.template = this.$route.params.template;
        this.form.subject = this.$route.params.template.subject;  
        this.form.html = this.$route.params.template.body; 
        this.form.to = this.$route.params.emails; 
        this.template = this.$route.params.template;  
      }else{
        this.allemails = this.$route.params.emails;
        this.form.to = this.$route.params.emails;
        this.template = this.$route.params.template;
      }
      

  },
};
</script>
