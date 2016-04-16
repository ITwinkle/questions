<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                    <h4 class="lead">
                        Our site is a privately held website, the flagship site of the Stack Exchange Network created in 2016 by Ihor Anishchenko. It was created to be a more open alternative to earlier Q&A sites such as Experts-Exchange. The name for the website was chosen by voting in March 2016

                        It features questions and answers on a wide range of topics in computer programming.

                        The website serves as a platform for users to ask and answer questions, and, through membership and active participation, to vote questions and answers up or down and edit questions and answers in a fashion similar to a wiki or Digg. Users of our site can earn reputation points and "badges"; for example, a person is awarded 10 reputation points for receiving an "up" vote on an answer given to a question, and can receive badges for their valued contributions, which represents a kind of gamification of the traditional Q&A site or forum. All user-generated content is licensed under a Creative Commons Attribute-ShareAlike license.

                        Closing questions is a main differentiation from Yahoo! Answers and a way to prevent low quality questions. The mechanism was overhauled in 2016; questions edited after being put "on hold" now appear in a review queue.
                        This site also has a Careers section to assist developers in finding their next opportunity. For employers,we provides tools to brand their business, advertise their openings on the site, and source candidates from our database of developers who are open to being contacted.
                    </h4>
                <hr style="border: 1px solid #000;" size="30">
                    <h2 class="post-title">
                        We have experts on such categories:
                    </h2>
                    <?php foreach($categories as $category):?>
                        <div class="text-left">
                            <li><a href="<?php echo $category['name']?>/experts"><?php echo $category['name']?></a></li>
                        </div>
                    <?php endforeach;?>
                <p class="post-meta">Site created by <a href="https://github.com/ITwinkle">Ihor Anishchenko</a> on March 3, 2016</p>
            </div>
            <hr>
        </div>
    </div>
</div>