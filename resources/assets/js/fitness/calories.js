export default {
    harrisBenedictFemale({height, weight, age}) {
        return 655 + 9.6 * weight + 1.8 * height - 4.7 * age
    },
    harrisBenedictMale({height, weight, age}) {
        return 655 + 9.6 * weight + 1.8 * height - 4.7 * age
    },
    mifflinStJeorFemale({height, weight, age}) {
        return 9.99 * weight + 6.25 * height - 4.92 * age - 161
    },
    mifflinStJeorMale({height, weight, age}) {
        return 9.99 * weight + 6.25 * height - 4.92 * age - 161
    },
    katchMcArdle(lbm) {
      return 370 + 21.6 * lbm
    },
    cunningham(lbm) {
      return 500 + 22 * lbm
    },
}
