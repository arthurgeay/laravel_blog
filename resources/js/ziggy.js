    var Ziggy = {
        namedRoutes: {"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"],"domain":null},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"],"domain":null},"debugbar.telescope":{"uri":"_debugbar\/telescope\/{id}","methods":["GET","HEAD"],"domain":null},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"],"domain":null},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"],"domain":null},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"],"domain":null},"api.allPosts":{"uri":"api\/posts","methods":["GET","HEAD"],"domain":null},"api.comment.index":{"uri":"api\/comments\/{post}","methods":["GET","HEAD"],"domain":null},"api.comment.store":{"uri":"api\/comments\/{post}","methods":["POST"],"domain":null},"api.comment.report":{"uri":"api\/comments\/{comment}\/report","methods":["GET","HEAD"],"domain":null},"api.post.store":{"uri":"api\/posts","methods":["POST"],"domain":null},"api.post.update":{"uri":"api\/posts\/{post}\/edit","methods":["PUT"],"domain":null},"api.allPosts.owner":{"uri":"api\/posts\/mine","methods":["GET","HEAD"],"domain":null},"api.post.destroy":{"uri":"api\/posts\/{post}","methods":["DELETE"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"post.edit":{"uri":"posts\/{post}\/edit","methods":["GET","HEAD"],"domain":null},"post.add":{"uri":"posts\/add","methods":["GET","HEAD"],"domain":null},"post.show":{"uri":"posts\/{post}","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://localhost/blog_laravel/public/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
