This is a free plugin and allows you to automate your github builds to Headless Wordpress, there is another popular webhook plugin for wordpress but you have to use the paid PRO version
in order to send post variables on that... meaning you can't use it for Github workflow_dispatch because the "ref" post content variable is required and since the other popular webhook
plugin for wordpress doesn't allow you to set post content variables without going PRO, you essentially need to pay to use it with Github Actions.

The plugin has 3 fields

the field for your Github api token (Both fine grained and not are allowed)

The endpoint url which is the url that ends in /dispatches

And the branch.

Put those in and every time you create a post or update one the webhook will be sent, deletion will be added in later versions, and of course more finegrain control.