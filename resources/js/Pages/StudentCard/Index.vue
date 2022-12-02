<template>
  <Head title="Журнал куратора - Карта персонифицированного учета" />
  <div class="row items-center">
    <div class="col-1 text-center">
      <img class="img-fluid" src="https://dummyimage.com/100x100/000/fff" alt="Фото учащегося" />
    </div>
    <div class="col-11">
      <div class="row">
        <div class="col">
          <TextField label="1. Фамилия" :value="student.user.surname" />
        </div>
        <div class="col">
          <TextField label="2. Имя" :value="student.user.first_name" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <TextField label="3. Отчество" :value="student.user.middle_name" />
        </div>
        <div class="col">
          <TextField label="4. Дата рождения" :value="student.user.birthday" />
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col">
          <TextField label="5. Гражданство" :value="student.user.citizenship" />
        </div>
        <div class="col">
          <TextField label="6. Окончил УО" :value="student.graduated" />
        </div>
      </div>
      <TextField label="7. Паспортные данные" :value="student.passport_data" />
      <TextField label="8. Домашний адрес, телефон" :value="addressAndPhone" />
      <TextField label="9. Место проживания в период обучения" :value="student.address" />
      <TextField label="10. Сведения о состоянии здоровья" :value="student.health" />
      11. Сведения о семье: ФИО, дата рождения, гражданство, место жительства и (или) место пребывания, место работы
      родителей или других законных представителей

      <TextField v-if="father" label="Отец" :value="UserService.info(father)" />
      <TextField v-else label="Отец" />

      <TextField v-if="mother" label="Мать" :value="UserService.info(mother)" />
      <TextField v-else label="Мать" />

      <TextField label="Другие члены семьи" :value="otherFamilyMembersTextField" />

      <TextField label="12. Отношения учащегося с членами семьи, попечителем и др." :value="student.relationship" />
      <TextField label="13. Увлечения" :value="student.hobbies" />
      <TextField label="14. Другие сведения" :value="student.other_details" />
      15. Поощрения учащегося:
      <q-markup-table>
        <thead>
          <tr>
            <th>Дата</th>
            <th>За какие достижения</th>
            <th>Форма поощрения</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="achievement in student.achievements">
            <td>{{ achievement.date }}</td>
            <td>{{ achievement.reason }}</td>
            <td>{{ achievement.encouragement }}</td>
          </tr>
        </tbody>
      </q-markup-table>
      16. Факты ассоциального поведения учащегося
      <q-markup-table>
        <thead>
          <tr>
            <th>Дата</th>
            <th>Характер проявления</th>
            <th>Меры</th>
            <th>Результат</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="violation in student.violations">
            <td>{{ violation.date }}</td>
            <td>{{ violation.actions }}</td>
            <td>{{ violation.measures }}</td>
            <td>{{ violation.result }}</td>
          </tr>
        </tbody>
      </q-markup-table>
      <h2 class="text-h4 text-center">Рекомендации специалистов</h2>
      <q-markup-table>
        <thead>
          <tr>
            <th>
              Рекомендации педагога-психолога, педагога социального<br />
              (психологическая диагностика, консультирование)
            </th>
            <th>Результат</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="recommendation in student.recommendations">
            <td>{{ recommendation.recommendation }}</td>
            <td>{{ recommendation.result }}</td>
          </tr>
        </tbody>
      </q-markup-table>
      <h2 class="text-h4 text-center">Индивидуальная работа с родителями (другими законными представителями)</h2>
      <q-markup-table>
        <thead>
          <tr>
            <th>Дата</th>
            <th>Содержание работы</th>
            <th>Результат</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="individual_work in parentsIndividualWork">
            <td>{{ individual_work.date }}</td>
            <td>{{ individual_work.content }}</td>
            <td>{{ individual_work.result }}</td>
          </tr>
        </tbody>
      </q-markup-table>
      <h2 class="text-h4 text-center">Индивидуальная работа с учащимися</h2>
      <q-markup-table>
        <thead>
          <tr>
            <th>Дата</th>
            <th>Содержание работы</th>
            <th>Результат</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="individual_work in studentsIndividualWork">
            <td>{{ individual_work.date }}</td>
            <td>{{ individual_work.content }}</td>
            <td>{{ individual_work.result }}</td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Student, User, Achievement, Violation, IndividualWork, Recommendation, FamilyMember } from '@/types'
import TextField from '@/components/TextField.vue'
import { UserService } from '@/services/UserService'

const props = defineProps<{
  student: Student & {
    user: User
    achievements: Achievement[]
    violations: Violation[]
    recommendations: Recommendation[]
    individual_work: IndividualWork[]
    family_members: (User & { pivot: FamilyMember })[]
  }
}>()

const addressAndPhone = computed(
  () =>
    `${props.student.user.address}, <a href="tel:+${props.student.user.phone_number}">+${props.student.user.phone_number}</a>`
)

const parentsIndividualWork = computed<IndividualWork[]>(() =>
  props.student.individual_work.filter((individualWork) => individualWork.type === 'parents')
)

const studentsIndividualWork = computed<IndividualWork[]>(() =>
  props.student.individual_work.filter((individualWork) => individualWork.type === 'students')
)

const familyMembers = computed(() => props.student.family_members)

const mother = computed<(User & { pivot: FamilyMember }) | undefined>(() =>
  familyMembers.value.find((familyMember) => familyMember.pivot.type === 'mother')
)

const father = computed<(User & { pivot: FamilyMember }) | undefined>(() =>
  familyMembers.value.find((familyMember) => familyMember.pivot.type === 'father')
)

const otherFamilyMembers = computed(() =>
  familyMembers.value.filter(
    (familyMember) => familyMember.pivot.type !== 'mother' && familyMember.pivot.type !== 'father'
  )
)

const otherFamilyMembersTextField = computed(() =>
  otherFamilyMembers.value
    .map((familyMember) => {
      let status = ''

      if (familyMember.pivot.type === 'brother') {
        status = 'брат'
      }

      if (familyMember.pivot.type === 'sister') {
        status = 'сестра'
      }

      return `(${status}) ${UserService.info(familyMember)}`
    })
    .join('<br>')
)
</script>
