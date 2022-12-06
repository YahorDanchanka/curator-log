export interface IUser {
  id: number
  login: string
  surname: string
  first_name: string
  middle_name: string
  sex: 'male' | 'female'
  birthday: string
  citizenship: string
  job: string | null
  phone_number: string | null
  password: string
  remember_token: string | null
  created_at: string | null
  updated_at: string | null
  info: string
}

export interface IStudent {
  id: number
  home_phone_number: string | null
  graduated: string
  relationship: string | null
  hobbies: string | null
  address: string | null
  health: string
  social_conditions: string | null
  apprenticeship: string
  certificate_date: string
  other_details: string | null
  user_id: number
  created_at: string | null
  updated_at: string | null
  mother: IUser | null
  father: IUser | null
  family_members: IUser[]
}

export interface IAddress {
  id: number
  region: string
  district: string
  residenceType: string
  residence: string
  street: string
  user_id: number
  created_at: string | null
  updated_at: string | null
  to_string: string
}

export interface IAchievement {
  date: string
  reason: string
  encouragement: string
}

export interface IViolation {
  date: string
  actions: string
  measures: string
  result: string
}

export interface IRecommendation {
  recommendation: string
  result: string
}

export interface IIndividualWork {
  type: 'parents' | 'students'
  date: string
  content: string
  result: string
}

export interface IFamilyMember {
  type: 'mother' | 'father' | 'brother' | 'sister'
}

export interface IPassport {
  id: number
  series: string
  number: string
  district_department: string
  issue_date: string
  student_id: number
  created_at: string | null
  updated_at: string | null
  to_string: string
}
