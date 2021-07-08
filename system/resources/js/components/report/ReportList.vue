<template>
    <div class="container">
<!--        只要不是RD都能回報-->
        <div v-if=" userInfo.user_role != 4">
            <button @click="addNewReport()" class="btn btn-primary"> 新增回報 </button>
        </div>
        <div class="row">
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            回報標題
                        </th>
                        <th>
                            回報處理狀態
                        </th>
                        <th>
                            回報使用者
                        </th>
                        <th>
                            回報概述
                        </th>
                        <th>
                            回報問題優先度
                        </th>
                        <th>
                            回報問題嚴重度
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for=" Reporting in Reportings " :key="Reporting.id">
                        <td>
                            {{ Reporting.id}}
                        </td>
                        <td>
                            {{ Reporting.report_title}}
                        </td>
                        <td>
                            <div v-if="Reporting.report_states == 0 ">
                                未解決
                            </div>
                            <div v-else>
                                已解決
                            </div>
                        </td>
                        <td>
                            {{ Reporting.report_user}}
                        </td>
                        <td>
                            {{ Reporting.report_summary}}
                        </td>
                        <td>
                            {{ Reporting.priority}}
                        </td>
                        <td>
                            {{ Reporting.severity}}
                        </td>
                        <td>
                            <div v-if="Reporting.report_states == 0">

                                <button class="btn btn-info"
                                        v-if="userInfo.user_role == 4 && (Reporting.report_type ==1 || Reporting.report_type ==2 )"
                                        @click="btnReply(Reporting.id)"> 已解決 </button>
                                <button class="btn btn-info"
                                        v-else-if="userInfo.user_role == 3 && Reporting.report_type == 3"
                                        @click="btnReply(Reporting.id)"> 已解決 </button>
                                <button class="btn btn-info"
                                        v-else-if="userInfo.user_role == 1"
                                        @click="btnReply(Reporting.id)"> 已解決 </button>
                            </div>
                            <div v-if="userInfo.user_role ==1 ">
                                <button class="btn btn-primary" @click="EditReport(Reporting.id)"> 編輯 </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReportList",
    data(){
        return {
            Reportings: [],
            userInfo: {},
        }
    },
    created() {
        this.userInfo = this.$store.state.userInfo;
        this.axios
            .get('/api/report')
            .then( response => {
                this.Reportings = response.data;

            })
    },
    methods:
        {
            addNewReport()
            {
                this.$router.push({
                    name: 'NewReport'
                })
            },
            async btnReply(id)
            {
                this.axios
                    .post('/api/report/reslove',{id:id, userId:this.userInfo.id})
                    .then( response => {
                        this.$router.go(0);
                    })
            },
            EditReport(id)
            {
                this.$router.push(
                    {
                        name: 'EditReport',
                        params: {
                            id:id
                        }
                    }
                );
            }
        }

}
</script>

<style scoped>

</style>
