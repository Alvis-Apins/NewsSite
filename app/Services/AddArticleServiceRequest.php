<?php

namespace App\Services;

class AddArticleServiceRequest
{

  private string $title;
  private string $url;
  private string $pictureUrl;
  private string $content;

  public function __construct(string $title, string $url, string $pictureUrl, string $content)
  {
    $this->title = $title;
    $this->url = $url;
    $this->pictureUrl = $pictureUrl;
    $this->content = $content;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function getPictureUrl(): string
  {
    return $this->pictureUrl;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function getUrl(): string
  {
    return $this->url;
  }
}
