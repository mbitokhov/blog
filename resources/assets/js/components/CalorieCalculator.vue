<template>
  <div>
    <div class="columns">
      <div class="column">
        <div class="columns">
          <div class="column">
            <div class="control">
              <label for="gender" class="label"> Gender: </label>
              <div class="select">
                <select id="gender" class="input" v-model="fitnessData.gender" v-on:change="updateLocalStorage">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="control">
              <label for="weight" class="label"> Body weight: </label>
              <input id="weight" class="input" type="number" v-model="fitnessData.weight" v-on:change="updateLocalStorage">
            </div>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <div class="control">
              <label for="height" class="label"> Height: </label>
              <input id="height" class="input" type="number" v-model="fitnessData.height" v-on:change="updateLocalStorage">
            </div>
          </div>
          <div class="column">
            <div class="control">
              <label for="age" class="label"> Age: </label>
              <input id="age" class="input" type="number" v-model="fitnessData.age" v-on:change="updateLocalStorage">
            </div>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <div class="control">
              <label for="activity" class="label"> Activity Level: </label>
              <div class="select">
                <select id="activity" class="input" v-model="fitnessData.activity" v-on:change="updateLocalStorage">
                  <option value="1.2">Light to no exercise</option>
                  <option value="1.375">Light exercise (1-3 days per week)</option>
                  <option value="1.55">Moderate exercise (3-5 days per week)</option>
                  <option value="1.725">Heavy exercise (6-7 days per week)</option>
                  <option value="1.9">Very heavy exercise (twice per day)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="control">
              <label for="activity" class="label"> Body fat: </label>
              <input id="activity" class="input" type="percentage" v-model="fitnessData.bodyfat" v-on:change="updateLocalStorage">
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="table-container">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>BMR</th>
                <th>TDEE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Harris-Benedict</th>
                <td>{{ harrisBenedict | round }}</td>
                <td>{{ harrisBenedict * fitnessData.activity | round }}</td>
              </tr>
              <tr>
                <th>Mifflin-St Jeor</th>
                <td>{{ mifflinStJeor | round }}</td>
                <td>{{ mifflinStJeor * fitnessData.activity | round }}</td>
              </tr>
              <tr v-if="fitnessData.bodyfat != ''">
                <th>Katch-McArdle</th>
                <td>{{ katchMcArdle | round }}</td>
                <td>{{ katchMcArdle * fitnessData.activity | round }}</td>
              </tr>
              <tr v-if="fitnessData.bodyfat != ''">
                <th>Cunningham</th>
                <td>{{ cunningham | round }}</td>
                <td>{{ cunningham * fitnessData.activity | round }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import helpers from '../helpers.js'

export default {
  data: function () {
    return {
      fitnessData: helpers.getLocalStorage('fitness-data', {
        "weight": null,
        "bodyfat": null,
        "age": null,
        "height": null,
        "activity": null,
        "gender": null
      })
    }
  },
  methods: {
    updateLocalStorage: function (e) {
      helpers.setLocalStorage('fitness-data', this.fitnessData)
    }
  },
  computed: {
    kgWeight: function () {
      return this.fitnessData.weight / 2.204
    },
    cmHeight: function () {
      return this.fitnessData.height * 2.54
    },
    harrisBenedict: function () {
      if (this.fitnessData.gender === "male") {
        return 66 + 13.7 * this.kgWeight + 5 * this.cmHeight - 6.8 * this.fitnessData.age
      } else if (this.fitnessData.gender === "female") {
        return 655 + 9.6 * this.kgWeight + 1.8 * this.cmHeight - 4.7 * this.fitnessData.age
      }
    },
    mifflinStJeor: function () {
      if (this.fitnessData.gender === "male") {
        return 9.99 * this.kgWeight + 6.25 * this.cmHeight - 4.92 * this.fitnessData.age + 5
      } else if (this.fitnessData.gender === "female") {
        return 9.99 * this.kgWeight + 6.25 * this.cmHeight - 4.92 * this.fitnessData.age - 161
      }
    },
    katchMcArdle: function () {
      return 370 + 21.6 * this.lbm
    },
    cunningham: function () {
      return 500 + 22 * this.lbm
    },
    lbm: function () {
      return this.kgWeight * ( 1 - this.fitnessData.bodyfat / 100 )
    }
  }
}

</script>
