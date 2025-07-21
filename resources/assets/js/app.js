/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//require('../../../node_modules/materialize-css/dist/js/materialize.js');

require('../../../node_modules/jquery-ui-1.12.1.custom/jquery-ui.js');

require('../../../bower_components/select2/dist/js/select2.js');

require('../../../bower_components/axios/dist/axios.js');

require('../../../node_modules/datatables.net/js/jquery.dataTables.js');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
import qualification from './components/QualificationComponent.vue';
import jobhistory from './components/JobHistoryComponent.vue';
import skill from './components/SkillComponent.vue';
import markgrade from './components/MarkGradeComponent.vue';
import role from './components/RoleComponent.vue';
import teacherlog from './components/TeacherLogComponent.vue';
import studentlog from './components/StudentLogComponent.vue';
import experience from './components/ExperienceComponent.vue';
import teacherduty from './components/TeacherDutyComponent.vue';
import studentduty from './components/StudentDutyComponent.vue';

const app = new Vue({
    el: '#app',
    components: { qualification, jobhistory, skill, markgrade, role, teacherlog, studentlog, experience, teacherduty, studentduty }

});