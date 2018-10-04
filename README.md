[![Build Status](https://travis-ci.org/satanasov/postlove.svg?branch=master)](https://travis-ci.org/satanasov/postlove) [![Coverage Status](https://coveralls.io/repos/github/satanasov/postlove/badge.svg?branch=master)](https://coveralls.io/github/satanasov/postlove?branch=1.2.x)

Post Love for phpBB 3.2
==========

Description:

    Add "like"/love (as it uses small heart) to the posts.
    As a popup you can see who have liked/loved the post.
    Show most liked post(s) overall and per forum

Features:

    Postview:
        - Show small heart under every post
        - Toggle like/love
        - Show as tooltip who have liked the post
        - Show how many posts the user liked in mini profile (configurable)
        - Show how many of the user posts have been liked in mini profile (configurable)

    Indexview:
        - Show summary of N most liked posts of day/week/month/year/ever (configurable)

    Forumview:
        - Show summary of N most liked posts of day/week/month/year/ever (configurable)

    Notifications:
        - Notify author when a post has been liked

    ACP:
        - Enable/disable main CSS (CSS classes can be redefined)
        - Allow showing of liked posts count in mini profile (postview)
        - Allow showing of user's posts that have been liked count in mini profile (postview)
        - Configure number of posts for each period to show (Indexview and Forumview)
        - Configure caching time of summary queries (to improve efficiency)

Installation:

    - create $phpbb_root/ext/anavaro folder
    - cd $phpbb_root/ext/anavaro
    - git clone https://github.com/satanasov/postlove.git
    - Go to admin panel -> customize -> extensions -> install post love

Credits:

    @phpbb-es aka Raul [ThE KuKa]
	@R3gi
	@mhakfoort
    
Submitting translations/functions
    
    Please fork the repo and submit every translation/patch as Pull Request.
