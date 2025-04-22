## GothamFolio Security

I am taking site security seriously.

If you find any vulnerabilities, please contact me immediately over github or - preferably - Telegram at https://t.me/sirAndrewGotham

My general preference is not to use - or use as little as absolutely necessary - foreign packages.

Please don't get me wrong: there are extremely useful and professionally created packages out there.

But authors create those for themselves. When framework or any parts important to you get updated, packages do not follow. At least not immediately. This means you are out of luck installing most recent and most secure Laravel version if some of the packages were not updated (and some never will because of their abandoned status), as they will crush your update.

True, some of those packages receive a lot more testing and bug fixes, than this tiny little app of mine. And many of them are a lot more thought after. But as I said, an ability to easily handle any necessary changes in my application without necessity to juggle tons of strange foreign code in the process (when a package gets outdated and I have to do that package developer's job in order to keep up with my own development process) greatly outways benefits of speed development in favor of reliability and my own pease of mind.

So, 90% of this project code (that one beside the framework itself) is all my own. And I am trying to write secure code as much as I can.

At the same time, I would like to remind you that this is my own code written for myself. If you want to use it, you are free to do so. But be aware that I provide this code strictly on AS-IS bases.

If you use this code of mine, you use it on AS-IS bases and accept all responsibility for doing so, as well as all responsibility for any consequences if something goes wrong, either with the application, server, sercer-side software, or whatever it might be.

I have committed Roave Security Advisor to advise on security problems in the development environment.

This will tell you when and if there are problems with the Laravel framework or any packages you are trying to add to the project.

Please get in touch if you fiind any problems with the code.

WIth this, good luck in your Web development journey.

Sincerely,    
Sir. Andrew

P.S. Official security bulletins

Eah, just a reminder on where to look for official infos on security problems:

- github.com/laravel/framework/security/advisories
- nvd.nist.gov/vuln/search
- cve.mitre.org
- snyk.io/vuln
