<template>
  <Head title="Журнал куратора - Редактирование учащегося" />
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
import { IAddress, IPassport, IStudent, IUser } from '@/types'

const props = defineProps<{
  updateUrl: string
  errors: { [key: string]: string[] }
  student: IStudent
  user: IUser
  address: IAddress
  passport: IPassport
}>()

const user = reactive(props.user)
const student = reactive(props.student)
const address = reactive(props.address)
const passport = reactive(props.passport)

async function onSubmit() {
  // // @ts-ignore
  Inertia.put(props.updateUrl, {
    user,
    student,
    address,
    passport,
  })
}
</script>
