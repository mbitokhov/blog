export default {
  setLocalStorage: function (key, val) {
    if (typeof Storage === "undefined") {
      return;
    }
    localStorage.setItem(key, val);
  },
  getLocalStorage: function (key, def) {
    if (typeof Storage === "undefined") {
      return def;
    }
    var val = localStorage.getItem(key)

    return val === null ? def : val;
  }
}