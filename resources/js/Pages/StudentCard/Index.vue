<template>
  <Head title="Журнал куратора - Учащиеся" />
  <q-table
    class="q-mb-md"
    title="Учащиеся"
    row-key="name"
    :rows="students"
    :columns="columns"
    :visible-columns="visibleColumns"
  >
    <template v-slot:top>
      <div class="q-table__title">Учащиеся</div>
      <q-space />
      <q-select
        display-value="Колонки"
        style="min-width: 150px"
        v-model="visibleColumns"
        :options="columns"
        emit-value
        map-options
        option-value="name"
        options-cover
        multiple
        outlined
        dense
        options-dense
      />
    </template>

    <template v-slot:header="props">
      <q-tr :props="props">
        <q-th v-for="col in props.cols" :key="col.name" :props="props">
          {{ col.label }}
        </q-th>
        <q-th class="text-left">Действия</q-th>
      </q-tr>
    </template>

    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td v-for="col in props.cols" :key="col.name" :props="props">
          {{ col.value }}
        </q-td>
        <q-td>
          <q-btn
            class="q-mr-sm"
            color="primary"
            icon="edit"
            size="sm"
            :href="`/student-card/${props.row.id}/edit`"
            round
          />
          <q-btn color="negative" icon="delete" size="sm" round @click="deleteStudent(props.row.id)" />
        </q-td>
      </q-tr>
    </template>
  </q-table>
  <q-btn label="Создать" color="primary" href="/student-card/create" />
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue'
import moment from 'moment'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { IAddress, IPassport, IStudent, IUser } from '@/types'
import { Inertia } from '@inertiajs/inertia'

type IRow = IStudent & { user: IUser & { address: IAddress }; passport: IPassport }
defineProps<{ students: IRow[] }>()

const columns = [
  {
    name: 'surname',
    label: 'Фамилия',
    align: 'left',
    field: (student: IRow) => student.user.surname,
    sortable: true,
  },
  {
    name: 'first_name',
    label: 'Имя',
    align: 'left',
    field: (student: IRow) => student.user.first_name,
    sortable: true,
  },
  {
    name: 'middle_name',
    label: 'Отчество',
    align: 'left',
    field: (student: IRow) => student.user.middle_name,
    sortable: true,
  },
  {
    name: 'birthday',
    label: 'Дата рождения',
    align: 'left',
    field: (student: IRow) => student.user.birthday,
    sortable: true,
  },
  {
    name: 'age',
    label: 'Возвраст',
    align: 'left',
    field: (student: IRow) => moment().diff(student.user.birthday, 'years'),
    sortable: true,
  },
  {
    name: 'sex',
    label: 'Пол',
    align: 'left',
    field: (student: IRow) => (student.user.sex === 'male' ? 'Мужской' : 'Женский'),
    sortable: true,
  },
  {
    name: 'citizenship',
    label: 'Гражданство',
    align: 'left',
    field: (student: IRow) => student.user.citizenship,
    sortable: true,
  },
  {
    name: 'graduated',
    label: 'Школа',
    align: 'left',
    field: (student: IRow) => student.graduated,
    sortable: true,
  },
  {
    name: 'passport_series',
    label: 'Серия и номер паспорта',
    align: 'left',
    field: (student: IRow) => `${student.passport.series}${student.passport.number}`,
    sortable: true,
  },
  {
    name: 'district_department',
    label: 'РОВД',
    align: 'left',
    field: (student: IRow) => student.passport.district_department,
    sortable: true,
  },
  {
    name: 'issue_date',
    label: 'Дата выдачи паспорта',
    align: 'left',
    field: (student: IRow) => student.passport.issue_date,
    sortable: true,
  },
  {
    name: 'user_address',
    label: 'Прописка',
    align: 'left',
    field: (student: IRow) => student.user.address.to_string,
    sortable: true,
  },
  {
    name: 'student_address',
    label: 'Место проживания',
    align: 'left',
    field: (student: IRow) => student.address || student.user.address.to_string,
    sortable: true,
  },
  {
    name: 'phone_number',
    label: 'Телефон',
    align: 'left',
    field: (student: IRow) => student.user.phone_number,
    sortable: true,
  },
  {
    name: 'home_phone_number',
    label: 'Домашний телефон',
    align: 'left',
    field: (student: IRow) => student.home_phone_number,
    sortable: true,
  },
  {
    name: 'social_conditions',
    label: 'Социальные условия',
    align: 'left',
    field: (student: IRow) => student.social_conditions,
    sortable: true,
  },
  {
    name: 'hobbies',
    label: 'Увлечения',
    align: 'left',
    field: (student: IRow) => student.hobbies,
    sortable: true,
  },
  {
    name: 'health',
    label: 'Группа здоровья',
    align: 'left',
    field: (student: IRow) => student.health,
    sortable: true,
  },
  {
    name: 'certificate_date',
    label: 'Дата справки',
    align: 'left',
    field: (student: IRow) => student.certificate_date,
    sortable: true,
  },
  {
    name: 'apprenticeship',
    label: 'Основа',
    align: 'left',
    field: (student: IRow) => student.apprenticeship,
    sortable: true,
  },
  {
    name: 'other_details',
    label: 'Другие сведения',
    align: 'left',
    field: (student: IRow) => student.other_details,
    sortable: true,
  },
]

const visibleColumnsStorageKey = 'student-card_visible-columns'

const visibleColumns = ref(
  localStorage.getItem(visibleColumnsStorageKey)
    ? JSON.parse(localStorage.getItem(visibleColumnsStorageKey))
    : [
        'surname',
        'first_name',
        'middle_name',
        'birthday',
        'age',
        'sex',
        'citizenship',
        'graduated',
        'passport_series',
        'district_department',
        'issue_date',
        'user_address',
        'student_address',
        'phone_number',
        'home_phone_number',
        'social_conditions',
        'hobbies',
        'health',
        'certificate_date',
        'apprenticeship',
        'other_details',
      ]
)

function deleteStudent(id: number) {
  Inertia.delete(`/student-card/${id}`)
}

watch(visibleColumns, () => {
  localStorage.setItem(visibleColumnsStorageKey, JSON.stringify(visibleColumns.value))
})
</script>
