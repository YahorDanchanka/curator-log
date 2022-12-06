<template>
  <q-form greedy @submit.prevent="emit('submit')">
    <div class="row q-col-gutter-md">
      <div class="col-6">
        <q-input
          label="Фамилия"
          :model-value="props.user.surname"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Фамилия».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { surname: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Имя"
          :model-value="props.user.first_name"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Имя».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { first_name: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Отчество"
          :model-value="props.user.middle_name"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Отчество».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { middle_name: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Пол"
          :model-value="props.user.sex"
          :options="[
            { label: 'Мужской', value: 'male' },
            { label: 'Женский', value: 'female' },
          ]"
          emit-value
          map-options
          @update:model-value="(val) => emit('update:user', merge(props.user, { sex: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата рождения"
          :model-value="props.user.birthday"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата рождения».']"
          stack-label
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { birthday: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Гражданство"
          :model-value="props.user.citizenship"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Гражданство».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { citizenship: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Домашний телефон"
          :model-value="props.student.home_phone_number"
          @update:model-value="(val) => emit('update:student', merge(props.student, { home_phone_number: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Телефон"
          mask="(##) ###-##-##"
          :model-value="props.user.phone_number"
          unmasked-value
          @update:model-value="(val) => emit('update:user', merge(props.user, { phone_number: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Область"
          :model-value="props.address.region"
          :options="regions"
          @update:model-value="(val) => emit('update:address', merge(props.address, { region: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Район"
          :model-value="props.address.district"
          :options="districts"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Район».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:address', merge(props.address, { district: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Тип места жительства"
          :model-value="props.address.residenceType"
          :options="['Город', 'Деревня', 'Посёлок', 'Хутор', 'Агрогородок', 'Городской поселок']"
          @update:model-value="(val) => emit('update:address', merge(props.address, { residenceType: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Населённый пункт"
          :model-value="props.address.residence"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Населённый пункт».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:address', merge(props.address, { residence: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Улица"
          :model-value="props.address.street"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Улица».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:address', merge(props.address, { street: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Окончил УО"
          :model-value="props.student.graduated"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Окончил УО».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:student', merge(props.student, { graduated: val }))"
        />
      </div>
      <div class="col-6 text-center">
        <q-checkbox label="Там же" v-model="sameAddress" />
      </div>
      <div class="col-6">
        <q-input
          label="Адрес"
          :model-value="props.student.address"
          :disable="sameAddress"
          @update:model-value="(val) => emit('update:student', merge(props.student, { address: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Социальные условия"
          :model-value="props.student.social_conditions"
          @update:model-value="(val) => emit('update:student', merge(props.student, { social_conditions: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Увлечения"
          :model-value="props.student.hobbies"
          @update:model-value="(val) => emit('update:student', merge(props.student, { hobbies: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Другая информация"
          :model-value="props.student.other_details"
          @update:model-value="(val) => emit('update:student', merge(props.student, { other_details: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата справки"
          :model-value="props.student.certificate_date"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата справки».']"
          stack-label
          @update:model-value="(val) => emit('update:student', merge(props.student, { certificate_date: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Группа здоровья"
          :model-value="props.student.health"
          :options="['Основная', 'Подготовительная', 'Спец-мед группа', 'Освобождён от физры']"
          @update:model-value="(val) => emit('update:student', merge(props.student, { health: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Основа"
          :model-value="props.student.apprenticeship"
          :options="['Бюджет', 'Внебюджет']"
          @update:model-value="(val) => emit('update:student', merge(props.student, { apprenticeship: val }))"
        />
      </div>
      <div class="col-6">
        <q-select
          label="Серия паспорта"
          :model-value="props.passport.series"
          :options="['AB', 'BM', 'HB', 'KH', 'MP', 'MC', 'KB', 'PP', 'SP', 'DP']"
          @update:model-value="(val) => emit('update:passport', merge(props.passport, { series: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="Номер паспорта / личный номер"
          :model-value="props.passport.number"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Номер паспорта / личный номер».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:passport', merge(props.passport, { number: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          label="РОВД"
          :model-value="props.passport.district_department"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «РОВД».']"
          hide-bottom-space
          @update:model-value="(val) => emit('update:passport', merge(props.passport, { district_department: val }))"
        />
      </div>
      <div class="col-6">
        <q-input
          type="date"
          label="Дата выдачи паспорта"
          :model-value="props.passport.issue_date"
          :rules="[(val) => (val && val.length > 0) || 'Необходимо заполнить «Дата выдачи паспорта».']"
          hide-bottom-space
          stack-label
          @update:model-value="(val) => emit('update:passport', merge(props.passport, { issue_date: val }))"
        />
      </div>
      <div class="col-12">
        <q-btn type="submit" color="primary" label="Сохранить" />
      </div>
    </div>
  </q-form>
</template>

<script lang="ts" setup>
import { computed, ref, watch } from 'vue'
import { find, map, merge } from 'lodash'
import BelarusData from '@/data/belarus.json'

const emit = defineEmits(['update:user', 'update:student', 'update:address', 'update:passport', 'submit'])
const props = defineProps<{
  user: {
    surname: string
    first_name: string
    middle_name: string
    sex: string
    birthday: string
    citizenship: string
    phone_number: string
  }
  student: {
    home_phone_number: string
    graduated: string
    address: string
    social_conditions: string
    hobbies: string
    other_details: string
    certificate_date: string
    health: string
    apprenticeship: string
  }
  address: {
    region: string
    district: string
    residenceType: string
    residence: string
    street: string
  }
  passport: {
    series: string
    number: string
    district_department: string
    issue_date: string
  }
}>()

const sameAddress = ref(props.student.address === null)

const regions = computed<string[]>(() => map(BelarusData.regions, 'name'))
const districts = computed<string[]>(() => find(BelarusData.regions, ['name', props.address.region])?.districts || [])

watch(
  () => props.address.region,
  () => {
    emit('update:address', merge(props.address, { district: '' }))
  }
)

watch(sameAddress, (val) => {
  if (val) {
    emit('update:student', merge(props.student, { address: '' }))
  }
})
</script>
