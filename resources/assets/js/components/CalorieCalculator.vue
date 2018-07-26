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
                  <option value="1.2" selected>Light to no exercise</option>
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
        <div class="table-container" v-if="showCalculation || showLbmCalculation">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>BMR</th>
                <th>TDEE</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="showCalculation">
                <th>Harris-Benedict</th>
                <td>{{ harrisBenedict | round }}</td>
                <td>{{ harrisBenedict * fitnessData.activity | round }}</td>
              </tr>
              <tr v-if="showCalculation">
                <th>Mifflin-St Jeor</th>
                <td>{{ mifflinStJeor | round }}</td>
                <td>{{ mifflinStJeor * fitnessData.activity | round }}</td>
              </tr>
              <tr v-if="showLbmCalculation">
                <th>Katch-McArdle</th>
                <td>{{ katchMcArdle | round }}</td>
                <td>{{ katchMcArdle * fitnessData.activity | round }}</td>
              </tr>
              <tr v-if="showLbmCalculation">
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
import helpers from '../helpers/helpers.js'
import calories from '../fitness/calories.js'
import units from '../helpers/units.js'

export default {
  data() {
    let fitnessData = helpers.objectFromStorage('fitness-data', [
      'weight',  
      'bodyfat', 
      'age',     
      'height',  
      'activity',
      'gender'
    ])
    // defaults
    fitnessData.activity = fitnessData.activity || 1.2

    return {
      fitnessData 
    }
  },
  methods: {
    updateLocalStorage(e) {
      helpers.setLocalStorage('fitness-data', this.fitnessData)
    }
  },
  computed: {
    harrisBenedict() {
      if (this.fitnessData.gender === "male") {
        return calories.harrisBenedictMale(this.metricData)
      } else if (this.fitnessData.gender === "female") {
        return calories.harrisBenedictFemale(this.metricData)
      }
    },
    mifflinStJeor() {
      if (this.fitnessData.gender === "male") {
        return calories.mifflinStJeorMale(this.metricData)
      } else if (this.fitnessData.gender === "female") {
        return calories.mifflinStJeorFemale(this.metricData)
      }
    },
    katchMcArdle() {
        console.log(this.lbm)
      return calories.katchMcArdle(this.lbm)
    },
    cunningham() {
      return calories.cunningham(this.lbm)
    },
    metricData() {
      return {
        weight: units.lbToKg(this.fitnessData.weight),
        height: units.inToCm(this.fitnessData.height),
        age: this.fitnessData.age
      }
    },
    lbm: function () {
      return units.lbToKg(this.fitnessData.weight) * ( 1 - this.fitnessData.bodyfat / 100 )
    },
    showCalculation() {
      return this.fitnessData.weight && this.fitnessData.height && this.fitnessData.age
    },
    showLbmCalculation() {
      return this.fitnessData.weight && this.fitnessData.bodyfat
    }
  }
}

</script>
