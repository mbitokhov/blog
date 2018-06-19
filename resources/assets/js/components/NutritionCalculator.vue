<template>
  <div>
    <div class="columns">
      <div class="column is-one-fifth">
        <div class="field">
          <div class="control">
            <label>
              Total calories:
              <input class="input" type="number" v-model="calories">
            </label>
          </div>
        </div>
      </div>
      <div class="column is-one-fifth">
        <div class="field">
          <div class="control">
            <label>
              Lean body mass:
              <input class="input" type="number" v-model="lbm">
            </label>
          </div>
        </div>
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Grams</th>
          <th>Calories</th>
          <th>Percentage</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <th>Total</th>
          <th>{{ totalGrams | round }}</th>
          <th>{{ totalCalories | round }}</th>
          <th>{{ totalPercentage | round }}%</th>
        </tr>
      </tfoot>

      <tbody>
        <tr>
          <th>Carbs</th>
          <td>{{ carbGrams | round }}</td>
          <td>{{ carbCalories | round }}</td>
          <td>{{ carbPercentage | round }}%</td>
        </tr>
        <tr>
          <th>Protein</th>
          <td>{{ proteinGrams | round }}</td>
          <td>{{ proteinCalories | round }}</td>
          <td>{{ proteinPercentage | round }}%</td>
        </tr>
        <tr>
          <th>Fat</th>
          <td>{{ fatGrams | round }}</td>
          <td>{{ fatCalories | round }}</td>
          <td>{{ fatPercentage | round }}%</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      calories: 1200,
      lbm: 145
    };
  },
  filters: {
    round: function (v) {
      return Math.round(v)
    }
  },
  computed: {
    fatCalories: function () {
      return this.calories * .3
    },
    proteinCalories: function () {
      return this.proteinGrams * 4
    },
    carbCalories: function () {
      const c = this.calories - this.fatCalories - this.proteinCalories
      return c > 0 ? c : 0
    },
    fatGrams: function () {
      return this.fatCalories / 9
    },
    proteinGrams: function () {
      return this.lbm / 2.204 * 2.3
    },
    carbGrams: function () {
      return this.carbCalories / 4
    },
    fatPercentage: function () {
      return this.fatCalories / this.calories * 100
    },
    proteinPercentage: function () {
      return this.proteinCalories / this.calories * 100
    },
    carbPercentage: function () {
      return this.carbCalories / this.calories * 100
    },
    totalCalories: function () {
      return this.fatCalories + this.carbCalories + this.proteinCalories
    },
    totalGrams: function () {
      return this.fatGrams + this.carbGrams + this.proteinGrams
    },
    totalPercentage: function () {
      return this.fatPercentage + this.carbPercentage + this.proteinPercentage
    }
  }
}
</script>
