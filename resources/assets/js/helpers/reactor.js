function call(func) {
  if (typeof func !== 'function') {
    return
  }

  func()
}

function callMany(funcs) {
  if (! Array.isArray(funcs)) {
    return
  }

  funcs.forEach(function (func) {
    func()
  })
}

function makeSetter(reactor, key) {
  function makeMiddleware(func, next) {
    return (value) => func(value, next)
  }

  function makeMiddlewares(middlewares, next) {
    for(var i=middlewares.length-1; i >= 0; i--) {
      next = makeMiddleware(middlewares[i], next)
    }

    return next
  }

  var next = function (value) {
    reactor._data[key] = value

    return value
  }

  var middlewares = reactor._listeners.keys[key]
  if (middlewares !== undefined) {
    next = makeMiddlewares(middlewares, next)
  }

  middlewares = reactor._listeners.globals;
  if (middlewares !== undefined) {
    next = makeMiddlewares(middlewares, next)
  }

  return next
}

function makeGetter(reactor, key) {
  if (reactor._getters[key] !== undefined) {
    return reactor._getters[key]
  }

  return () => reactor._data[key]
}

function bind(reactor, reactive, key) {
  Object.defineProperty(reactive, key, {
    get: makeGetter(reactor, key),
    set: makeSetter(reactor, key)
  })
}

export default {
  make: function (obj) {
    return {
      _listeners: {
        keys: {}
      },
      _getters: {},
      _data: obj,

      addGlobalListener: function (func) {
        this._listeners['global'] = this._listeners['global'] || []
        this._listeners['global'].push(func)

        return this
      },

      addListener: function (key, func) {
        this._listeners.keys[key] = this._listeners.keys[key] || [];
        this._listeners.keys[key].push(func)

        return this
      },
      addGetter: function (key, func) {
        this._getters[key] = func

        return this
      },
      commit: function () {
        var reactive = {}

        Object.keys(this._data).forEach((key) => {
          bind(this, reactive, key)
				})

        return reactive
      }
    }
  },
}
