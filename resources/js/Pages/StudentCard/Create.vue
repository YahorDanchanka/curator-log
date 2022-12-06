<template>
  <Head title="Журнал куратора - Создание карты персонифицированного учета" />
  <div class="row q-mb-sm">
    <div v-if="!isEmpty(errors)" class="col-12">
      <q-banner inline-actions class="text-white bg-red">
        <template v-for="errorList in errors"> {{ errorList.join('<br />') }}<br /> </template>
      </q-banner>
    </div>
  </div>
  <StudentCardForm :user="user" :student="student" :address="address" :passport="passport" @submit="onSubmit" />
</template>

<script lang="ts" setup>
import { reactive } from 'vue'
import { isEmpty } from 'lodash'
import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import StudentCardForm from '@/components/StudentCardForm.vue'

const props = defineProps<{ storeUrl: string; errors: { [key: string]: string[] } }>()

const user = reactive({
  surname: '',
  first_name: '',
  middle_name: '',
  sex: 'male',
  birthday: '',
  citizenship: '',
  phone_number: '',
})

const student = reactive({
  home_phone_number: '',
  graduated: '',
  address: '',
  social_conditions: '',
  hobbies: '',
  other_details: '',
  certificate_date: '',
  health: 'Основная',
  apprenticeship: 'Бюджет',
})

const address = reactive({
  region: 'Гомельская',
  district: '',
  residenceType: 'Город',
  residence: '',
  street: '',
})

const passport = reactive({
  series: 'HB',
  number: '',
  district_department: '',
  issue_date: '',
})

async function onSubmit() {
  // @ts-ignore
  Inertia.post(props.storeUrl, {
    user,
    student,
    address,
    passport,
  })
}
</script>
