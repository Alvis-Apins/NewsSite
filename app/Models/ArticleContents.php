<?php

namespace App\Models;

class ArticleContents
{
  private string $title;
  private string $content;
  private string $published;
  private string $image;
  private string $source;
  private string $link;

  public function __construct(string $title, string $content, string $published, string $image, string $source, string $link)
  {
    $this->title = $title;
    $this->content = $content;
    $this->published = $published;
    $this->image = $image;
    $this->source = $source;
    $this->link = $link;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function getImage(): string
  {
    return $this->image;
  }

  public function getPublished(): string
  {
    return $this->published;
  }

  public function getLink(): string
  {
    return $this->link;
  }

  public function getSource(): string
  {
    return $this->source;
  }
}
