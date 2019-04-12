import { get } from '../helpers/api'

export default function (Vue) {

    Vue.student = {

        data: '',
        ready: false,


        init(_this, callback) {

            let component = this;

            get(_this, '/api/student', function (response) {

                component.data = response.data;
                component.ready = true;
                _this.$root.student = data;
                _this.$root.studentReady = true;

                callback();

            }, function () {

            });

        },

        getName() {

            return this.data ? this.data.name : '';

        },

        getId() {
            return this.data.id;
        },
    };

    Object.defineProperties(Vue.prototype, {
        $student: {
            get() {
                return Vue.student;
            }
        }
    })

}
