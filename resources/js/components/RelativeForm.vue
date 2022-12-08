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
          hide-bottom-space
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
        <q-select
          label="Тип родства"
          :model-value="props.familyMember.type"
          :options="[
            { label: 'Мать', value: 'mother' },
            { label: 'Отец', value: 'father' },
            { label: 'Брат', value: 'brother' },
            { label: 'Сестра', value: 'sister' },
          ]"
          emit-value
          map-options
          hide-bottom-space
          @update:model-value="(val) => emit('update:familyMember', merge(props.familyMember, { type: val }))"
        />
      </div>
      <div class="col-6">
        <q-field
          label="Телефон"
          :model-value="props.user.phone_number"
          @update:model-value="(val) => emit('update:user', merge(props.user, { phone_number: val }))"
        >
          <template v-slot:control="{ id, floatingLabel, modelValue, emitValue }">
            <input
              :id="id"
              class="q-field__input"
              data-maska="375-##-###-##-##"
              :value="modelValue"
              v-maska
              data-maska-eage
              @change="(e) => emitValue(e.target.value.match(/\d+/g).join(''))"
            />
          </template>
        </q-field>
      </div>
      <div class="col-6">
        <q-input
          label="Работа"
          :model-value="props.user.job"
          hide-bottom-space
          @update:model-value="(val) => emit('update:user', merge(props.user, { job: val }))"
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
      <div class="col-12">
        <q-btn type="submit" color="primary" label="Сохранить" />
      </div>
    </div>
  </q-form>
</template>

<script lang="ts" setup>
import { computed, watch } from 'vue'
import { find, map, merge } from 'lodash'
import { vMaska } from 'maska'
import BelarusData from '@/data/belarus.json'

const emit = defineEmits(['update:user', 'update:familyMember', 'update:address', 'submit'])
const props = defineProps<{
  user: {
    surname: string
    first_name: string
    middle_name: string
    sex: string
    birthday: string
    citizenship: string
    job: string | null
    phone_number: string
  }
  familyMember: {
    type: string
  }
  address: {
    region: string
    district: string
    residenceType: string
    residence: string
    street: string
  }
}>()

const regions = computed<string[]>(() => map(BelarusData.regions, 'name'))
const districts = computed<string[]>(() => find(BelarusData.regions, ['name', props.address.region])?.districts || [])

watch(
  () => props.address.region,
  () => {
    emit('update:address', merge(props.address, { district: '' }))
  }
)
</script>
