export default {
  setLocalStorage(key, val) {
    if (typeof Storage === "undefined") {
      return;
    }

    try {
      localStorage.setItem(key, JSON.stringify(val));
    } catch(e) {
      return false
    }

    return true
  },
  getLocalStorage(key, def) {
    if (typeof Storage === "undefined") {
      return def;
    }
    let val;

    try {
       val = localStorage.getItem(key)
    } catch(e) {
      return def
    }

    return val === null ? def : JSON.parse(val);
  },
  objectFromStorage(key, neededKeys) {
    let obj = this.getLocalStorage(key, {})

    neededKeys.forEach(key => {
      obj[key] = obj[key] || null
    })

    return obj
  },
}
