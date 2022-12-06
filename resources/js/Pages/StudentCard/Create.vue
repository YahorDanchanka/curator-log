<template>
  <Head title="Журнал куратора - Создание карты персонифицированного учета" />
  <q-form greedy @submit.prevent="onSubmit">
    <div class="row q-col-gutter-md">
      <div class="col-12"></div>
      <div v-if="!isEmpty(errors)" class="col-12">
        <q-banner inline-actions class="text-white bg-red">
          <template v-for="errorList in errors"> {{ errorList.join('<br />') }}<br /> </template>
        </q-banner>
      </div>
      <div class="col-6">
        <q-input
          label="Фамилия"
          v-model.trim="user.surname"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Фамилия».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="Имя"
          v-model.trim="user.first_name"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Имя».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="Отчество"
          v-model.trim="user.middle_name"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Отчество».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-select
          label="Пол"
          v-model="user.sex"
          :options="[
            { label: 'Мужской', value: 'male' },
            { label: 'Женский', value: 'female' },
          ]"
          emit-value
          map-options
        />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата рождения"
          v-model="user.birthday"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата рождения».']"
          stack-label
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="Гражданство"
          v-model.trim="user.citizenship"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Гражданство».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input label="Домашний телефон" v-model.trim="student.home_phone_number" />
      </div>
      <div class="col-6">
        <q-input label="Телефон" mask="(##) ###-##-##" v-model.trim="user.phone_number" unmasked-value />
      </div>
      <div class="col-6">
        <q-select label="Область" v-model="address.region" :options="regions" />
      </div>
      <div class="col-6">
        <q-select
          label="Район"
          v-model="address.district"
          :options="districts"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Район».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-select
          label="Тип места жительства"
          v-model="address.residenceType"
          :options="['Город', 'Деревня', 'Посёлок', 'Хутор', 'Агрогородок', 'Городской поселок']"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Населённый пункт"
          v-model.trim="address.residence"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Населённый пункт».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="Улица"
          v-model.trim="address.street"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Улица».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="Окончил УО"
          v-model.trim="student.graduated"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Окончил УО».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6 text-center">
        <q-checkbox label="Там же" v-model="sameAddress" />
      </div>
      <div class="col-6">
        <q-input label="Адрес" v-model.trim="student.address" :disable="sameAddress" />
      </div>
      <div class="col-6">
        <q-input label="Социальные условия" v-model.trim="student.social_conditions" />
      </div>
      <div class="col-6">
        <q-input label="Увлечения" v-model.trim="student.hobbies" />
      </div>
      <div class="col-6">
        <q-input label="Другая информация" v-model.trim="student.other_details" />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата справки"
          v-model="student.certificate_date"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата справки».']"
          stack-label
        />
      </div>
      <div class="col-6">
        <q-select
          label="Группа здоровья"
          v-model="student.health"
          :options="['Основная', 'Подготовительная', 'Спец-мед группа', 'Освобождён от физры']"
        />
      </div>
      <div class="col-6">
        <q-select label="Основа" v-model="student.apprenticeship" :options="['Бюджет', 'Внебюджет']" />
      </div>
      <div class="col-6">
        <q-select
          label="Серия паспорта"
          v-model="passport.series"
          :options="['AB', 'BM', 'HB', 'KH', 'MP', 'MC', 'KB', 'PP', 'SP', 'DP']"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Номер паспорта / личный номер"
          v-model.trim="passport.number"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Номер паспорта / личный номер».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          label="РОВД"
          v-model.trim="passport.district_department"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «РОВД».']"
          hide-bottom-space
        />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата выдачи паспорта"
          v-model.trim="passport.issue_date"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата выдачи паспорта».']"
          hide-bottom-space
          stack-label
        />
      </div>
      <div class="col-12">
        <q-btn type="submit" color="primary" label="Создать" />
      </div>
    </div>
  </q-form>
</template>

<script lang="ts" setup>
import { computed, reactive, ref, watch } from 'vue'
import { find, map, isEmpty } from 'lodash'
import { Head } from '@inertiajs/inertia-vue3'
import BelarusData from '@/data/belarus.json'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps<{ storeUrl: string; errors: { [key: string]: string[] } }>()

const sameAddress = ref(false)

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

const regions = computed<string[]>(() => map(BelarusData.regions, 'name'))
const districts = computed<string[]>(() => find(BelarusData.regions, ['name', address.region])?.districts || [])

async function onSubmit() {
  // @ts-ignore
  Inertia.post(props.storeUrl, {
    user,
    student,
    address,
    passport,
  })
}

watch(
  () => address.region,
  () => {
    address.district = ''
  }
)

watch(sameAddress, (val) => {
  if (val) {
    student.address = ''
  }
})
</script>
