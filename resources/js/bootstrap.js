import PusherJS from "pusher-js";

window.Pusher = new PusherJS(process.env.MIX_PUSHER_APP_KEY, {
  authEndpoint: "/broadcasting/auth",
  cluster: 'ap1',
  forceTLS: true,
  encrypted: true,
  disableStats: true,
  enabledTransports: ["ws", "wss"],
});
