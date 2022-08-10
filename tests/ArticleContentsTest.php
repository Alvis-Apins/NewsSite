<?php

use App\Models\ArticleContents;

test('Article contents model test', function () {
  $article = new ArticleContents(
    'News article title',
    'Text that describes what happened',
    '01.03.2022 10:53',
    'https://imageurl.pgn',
    'NewsSource',
    'https://articlesourceurl.lv'
  );

  expect($article->getTitle())->toEqual('News article title');
  expect($article->getContent())->toEqual('Text that describes what happened');
  expect($article->getPublished())->toEqual('01.03.2022 10:53');
  expect($article->getImage())->toEqual('https://imageurl.pgn');
  expect($article->getSource())->toEqual('NewsSource');
  expect($article->getLink())->toEqual('https://articlesourceurl.lv');
});
