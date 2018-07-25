<template>
  <div>
    <div class="columns">
      <div class="column is-one-fifth">
        <div class="control">
          <label for="calories-input" class="label">
            Total calories:
          </label>
          <input id="calories-input" class="input" type="number" v-model="calories">
        </div>
      </div>
      <div class="column is-one-fifth">
        <div class="control">
          <label for="lbm-input" class="label">
            Lean body mass:
          </label>
          <input id="lbm-input" class="input" type="number" v-model="lbm">
        </div>
      </div>
    </div>

    <div class="table-container">
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
  </div>
</template>

<script>
import helpers from '../helpers/helpers.js'

export default {
  data: function () {
    return {
      calories: helpers.getLocalStorage('nutrition-calculator-calories', 2000),
      lbm: helpers.getLocalStorage('nutrition-calculator-lbm', 130)
    };
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
      return this.fatCalories / this.totalCalories * 100
    },
    proteinPercentage: function () {
      return this.proteinCalories / this.totalCalories * 100
    },
    carbPercentage: function () {
      return this.carbCalories / this.totalCalories * 100
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
  },
  watch: {
    calories: function (v) {
      helpers.setLocalStorage('nutrition-calculator-calories', v)
    },
    lbm: function (v) {
      helpers.setLocalStorage('nutrition-calculator-lbm', v)
    }
  }
}
</script>
