<template>
    <div class="container">
        <div>
            {{ pagetitle }}
        </div>
        <div class="row">
            <div class="col-md-8">
                <form @submit.prevent="onSubmit">
                    <input type="hidden" v-model="Report.userId">
                    <div class="form-group">
                        <label>問題標題</label>
                        <input type="text" class="form-control" v-model="Report.report_title" :class="{'is-invalid' : !! error.report_title}" >
                        <div :class="{'invalid-feedback' : !! error.report_title }" v-if=" !! error.user_account">{{ error.report_title}}</div>
                    </div>
                    <div class="form-group">
                        <label>問題類別</label>
                        <select v-model="Report.report_type" :class="{'is-invalid' : !! error.report_type}" >
                            <option v-for="item in Report_type" v-bind:value="item.value">
                                {{ item.name }}
                            </option>
                        </select>
                        <div :class="{'invalid-feedback' : !! error.report_type }" v-if=" !! error.report_type">{{ error.report_type}}</div>
                    </div>
                    <div class="form-group" v-if="actions=='edit'">
                        <label>問題狀態</label>
                        <select v-model="Report.report_states">
                            <option value="0">未解決</option>
                            <option value="1">已解決</option>
                        </select>
                        <div :class="{'invalid-feedback' : !! error.report_type }" v-if=" !! error.report_type">{{ error.report_type}}</div>
                    </div>
                    <div class="form-group">
                        <label> 請選擇問題優先度: </label>
                        <select class="form-select" v-model="Report.report_priority" :class="{'is-invalid' : !! error.report_priority}" >
                            <option> 請選擇 </option>
                            <option value="1">最優先</option>
                            <option value="2">普通</option>
                            <option value="3">暫緩</option>
                        </select>
                        <div :class="{'invalid-feedback' : !! error.report_priority }" v-if=" !! error.report_priority">{{ error.report_priority}}</div>
                    </div>
                    <div class="form-group">
                        <label> 請選擇問題嚴重度: </label>
                        <select class="form-select" v-model="Report.report_severity" :class="{'is-invalid' : !! error.report_severity}" >
                            <option> 請選擇 </option>
                            <option value="1">最嚴重</option>
                            <option value="2">比較嚴重</option>
                            <option value="3">普通</option>
                            <option value="4">不算嚴重</option>
                        </select>
                        <div :class="{'invalid-feedback' : !! error.report_severity }" v-if=" !! error.report_severity">{{ error.report_severity}}</div>
                    </div>
                    <div class="form-group">
                        <label>問題概述</label>
                        <input type="text" class="form-control" v-model="Report.report_summary" :class="{'is-invalid' : !! error.report_summary}" >
                        <div :class="{'invalid-feedback' : !! error.report_summary }" v-if=" !! error.report_summary">{{ error.report_summary}}</div>
                    </div>
                    <div class="form-group">
                        <label>問題詳細內容</label>
                        <textarea v-model="Report.report_desc" :class="{'is-invalid' : !! error.report_desc}" ></textarea>
                        <div :class="{'invalid-feedback' : !! error.report_desc }" v-if=" !! error.report_desc">{{ error.report_desc}}</div>
                    </div>
                    <button class="btn btn-primary" type="submit">送出</button>
                    <button class="btn btn-secondary" type="button" @click="$router.go(-1);">返回上一頁</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditReport",
    data (){
        return {
            Report: {},
            pagetitle: '',
            Report_type : [],
            actions: '',
            error: {},
        }
    },
    created() {
        if(this.$route.params.id)
        {
            this.pagetitle = '問題編輯頁面';
            this.actions = 'edit';

            this.axios
                .get(`/api/report/${this.$route.params.id}`)
                .then( response => {
                    this.Report = response.data;
                })
        }
        else
        {
            this.pagetitle = '問題回報頁面';
            this.actions = 'new';
            this.Report.report_states = 0;
        }

        this.axios
            .get(`/api/gettype/${this.$store.state.userInfo.user_role}`)
            .then(response => {
                console.log(response.data)
                this.Report_type = response.data
            })

    },
    methods:
        {
            onSubmit(){
                this.error = {};
                if(!this.Report.report_title) this.error.report_title = '問題標題不能為空';
                if(!this.Report.report_type) this.error.report_type = '請選擇問題類別';
                if(!this.Report.report_priority) this.error.report_priority = '請選擇問題優先度';
                if(!this.Report.report_severity) this.error.report_severity = '請選擇問題嚴重度';
                if(!this.Report.report_summary) this.error.report_summary = '問題概述不能為空';
                if(!this.Report.report_desc) this.error.report_desc = '請填寫問題詳細內容';
                if(JSON.stringify(this.error) !== '{}' ) return;

                if(this.actions == 'new')
                {
                    //新增問題
                    this.axios
                        .post('/api/report',this.Report)
                        .then(response => {
                            this.$router.push({
                                name: 'Report'
                            })
                        })
                        .catch( err => console.log(err))
                        .finally( () => this.loading = false)
                }
                else
                {
                    this.Report.userId = this.$store.state.userInfo.id;
                    //編輯問題
                    this.axios
                        .patch(`/api/report/${this.$route.params.id}`,this.Report)
                        .then(response => {
                            this.$router.push({
                                name: 'Report'
                            })
                        })
                        .catch( err => console.log(err))
                        .finally( () => this.loading = false)
                }
            },

        }
}
</script>

<style scoped>

</style>
