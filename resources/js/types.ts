export interface User {
  surname: string
  first_name: string
  middle_name: string
  birthday: string
  citizenship: string
  address: string
  job: string
  phone_number: string
}

export interface Student {
  graduated: string
  passport_data: string
  relationship: string
  hobbies: string
  address: string
  health: string
  other_details: string | null
}

export interface Achievement {
  date: string
  reason: string
  encouragement: string
}

export interface Violation {
  date: string
  actions: string
  measures: string
  result: string
}

export interface Recommendation {
  recommendation: string
  result: string
}

export interface IndividualWork {
  type: 'parents' | 'students'
  date: string
  content: string
  result: string
}

export interface FamilyMember {
  type: 'mother' | 'father' | 'brother' | 'sister'
}
