import { User } from '../types'

export class UserService {
  static info(user: User): string {
    return `${this.fullName(user)}, ${user.birthday}, ${user.citizenship}, ${user.address}, ${user.job}`
  }

  static fullName(user: User): string {
    return `${user.surname} ${user.first_name} ${user.middle_name}`
  }
}
